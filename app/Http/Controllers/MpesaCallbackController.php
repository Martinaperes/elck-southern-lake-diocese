<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MpesaService;
use App\Models\Donation;

class MpesaCallbackController extends Controller
{
    protected $mpesa;

    public function __construct(MpesaService $mpesa)
    {
        $this->mpesa = $mpesa;
    }

    /**
     * Initiates an STK Push (user triggers donation)
     */
    public function initiate(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
            'phone' => 'required|string',
        ]);

        // Create pending donation
        $donation = Donation::create([
            'member_id' => auth()->id(),
            'amount' => $validated['amount'],
            'payment_method' => 'Mpesa',
            'purpose' => 'tithe',
            'status' => 'pending',
        ]);

        // Trigger STK Push
        $response = $this->mpesa->stkPush(
            $validated['amount'],
            $validated['phone'],
            'ChurchDonation',
            'Tithe'
        );

        if (isset($response['CheckoutRequestID'])) {
            $donation->transaction_code = $response['CheckoutRequestID'];
            $donation->save();
        }

        return back()->with('success', 'M-Pesa prompt sent! Complete the payment on your phone.');
    }

    /**
     * Handles M-Pesa callback from Safaricom
     */
    public function handle(Request $request)
    {
        $data = $request->all();

        if (isset($data['Body']['stkCallback']['CheckoutRequestID'])) {
            $checkoutID = $data['Body']['stkCallback']['CheckoutRequestID'];

            $donation = Donation::where('transaction_code', $checkoutID)->first();

            if ($donation) {
                $donation->status = $data['Body']['stkCallback']['ResultCode'] == 0
                    ? 'completed'
                    : 'failed';
                $donation->completed_at = now();
                $donation->save();
            }
        }

        return response()->json(['success' => true]);
    }
}
