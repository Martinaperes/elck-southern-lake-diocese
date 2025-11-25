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
        $validated = $request->validate([
            'amount' => 'required|numeric|min:10',
            'phone' => 'required|string|regex:/^2547\d{8}$/',
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

        if(isset($response['CheckoutRequestID'])){
            $donation->transaction_code = $response['CheckoutRequestID'];
            $donation->save();
        }

        return back()->with('success', 'M-Pesa prompt sent! Complete the payment on your phone.');
    }

    // Optional: AJAX polling for live table
    public function userDonations()
    {
        $donations = auth()->user()->donations()->latest()->get();
        return response()->json(['donations' => $donations]);
    }
}
