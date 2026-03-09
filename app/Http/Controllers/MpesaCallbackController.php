<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;
use Illuminate\Support\Facades\Log;

class MpesaCallbackController extends Controller
{
    public function handleStkCallback(Request $request)
    {
        // 1. Log the raw data for debugging
        Log::info('M-Pesa Callback Received', $request->all());

        // 2. Extract data from M-Pesa
        $data = $request->input('Body.stkCallback');
        $resultCode = $data['ResultCode'] ?? 1;
        $checkoutRequestID = $data['CheckoutRequestID'] ?? '';

        // 3. Find the donation
        $donation = Donation::where('transaction_code', $checkoutRequestID)->first();

        // Fallback: If not found by CheckoutRequestID, try by phone + amount
        if (!$donation) {
            $donation = Donation::where('payment_method', 'mpesa')
                ->where('status', 'pending')
                ->where('amount', $data['CallbackMetadata']['Item'][0]['Value'] ?? 0)
                ->latest()
                ->first();
        }

        if ($donation) {
            if ($resultCode == 0) {
                // Success
                $metadata = $data['CallbackMetadata']['Item'];
                $mpesaReceiptNumber = '';

                foreach ($metadata as $item) {
                    if ($item['Name'] === 'MpesaReceiptNumber') {
                        $mpesaReceiptNumber = $item['Value'];
                        break;
                    }
                }

                $donation->update([
                    'status' => 'completed',
                    'transaction_code' => $mpesaReceiptNumber,
                    'completed_at' => now(),
                ]);

                Log::info("Donation {$donation->id} marked as completed. Receipt: {$mpesaReceiptNumber}");
            } else {
                // Failed
                $donation->update([
                    'status' => 'failed',
                    'notes' => $data['ResultDesc'] ?? 'Payment failed',
                ]);

                Log::warning("Donation {$donation->id} failed. Reason: " . ($data['ResultDesc'] ?? 'Unknown'));
            }
        } else {
            Log::error('Donation not found for CheckoutRequestID: ' . $checkoutRequestID);
        }

        // 4. Return the required JSON response to Safaricom
        return response()->json([
            'ResultCode' => 0,
            'ResultDesc' => 'Accepted'
        ]);
    }
}