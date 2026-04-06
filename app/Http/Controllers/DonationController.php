<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;
use App\Services\MpesaService;

class DonationController extends Controller
{
    protected $mpesa;

    public function __construct(MpesaService $mpesa)
    {
        $this->mpesa = $mpesa;
    }

    // Show the donation form
    public function create()
    {
        return view('donations.give'); // Your donation form blade
    }

    // Handle form submission
    public function store(Request $request)
    {
        // Normalize phone number to format: 2547XXXXXXXX or 2541XXXXXXXX
        $phone = $request->input('phone');
        $phone = preg_replace('/\D/', '', $phone); // Remove non-digits
        
        if (str_starts_with($phone, '0')) {
            $phone = '254' . substr($phone, 1);
        } elseif (strlen($phone) == 9 && (str_starts_with($phone, '7') || str_starts_with($phone, '1'))) {
            $phone = '254' . $phone;
        }

        $request->merge(['phone' => $phone]);

        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
            'phone' => ['required', 'string', 'regex:/^254[17][0-9]{8}$/'],
            'purpose' => 'required|string|max:255',
        ]);

        $donation = Donation::create([
            'member_id' => auth()->id(),
            'amount' => $validated['amount'],
            'payment_method' => 'mpesa',
            'purpose' => $validated['purpose'],
            'status' => 'pending',
        ]);

        // Trigger STK Push
        $response = $this->mpesa->stkPush($validated['amount'], $validated['phone'], 'ChurchDonation', $validated['purpose']);

        if(isset($response['ResponseCode']) && $response['ResponseCode'] == '0'){
            $donation->update([
                'transaction_code' => $response['CheckoutRequestID'] ?? null,
            ]);
            return back()->with('success', 'M-Pesa prompt sent! Complete the payment on your phone.')
                         ->with('checkout_request_id', $response['CheckoutRequestID'] ?? null);
        }

        // If initiation failed
        return back()->withErrors(['mpesa' => $response['CustomerMessage'] ?? 'Failed to initiate M-Pesa payment. Please try again.']);
    }

    // Optional: AJAX polling for live table
    public function userDonations()
    {
        $donations = auth()->user()->donations()->latest()->get();
        return response()->json(['donations' => $donations]);
    }

    public function checkStatus($checkoutRequestId)
    {
        $response = $this->mpesa->verifyTransaction($checkoutRequestId);
        
        // If the transaction is completed, update the donation in our DB
        if (isset($response['transaction_status'])) {
            $donation = Donation::where('transaction_code', $checkoutRequestId)->first();
            
            if ($donation) {
                if ($response['transaction_status'] === 'completed') {
                    $donation->update([
                        'status' => 'completed',
                        'transaction_code' => $response['data']['mpesa_receipt_number'] ?? $checkoutRequestId
                    ]);
                } elseif ($response['transaction_status'] === 'failed') {
                    $donation->update(['status' => 'failed']);
                }
            }
        }
        
        return response()->json($response);
    }
}
