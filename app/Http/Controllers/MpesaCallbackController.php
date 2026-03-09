<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class MpesaCallbackController extends Controller
{
    /**
     * Handle STK Push callback from M-Pesa.
     */
    public function handleStkCallback(Request $request)
    {
        Log::info('M-Pesa STK Callback received', $request->all());

        // Forward a copy of the callback to your external hosted script as requested
        try {
            Http::timeout(5)->post('http://elck.quickzingo.com/mpesacallback/callback.php', $request->all());
            Log::info('M-Pesa Callback successfully forwarded to external URL.');
        } catch (\Exception $e) {
            Log::warning('External callback forwarding failed: ' . $e->getMessage());
        }

        $data = $request->input('Body.stkCallback');
        $resultCode = $data['ResultCode'];
        $checkoutRequestID = $data['CheckoutRequestID'];

        $donation = Donation::where('transaction_code', $checkoutRequestID)->first();

        if (!$donation) {
            Log::error('Donation not found for CheckoutRequestID: ' . $checkoutRequestID);
            return response()->json(['ResultCode' => 1, 'ResultDesc' => 'Donation not found']);
        }

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
                'transaction_code' => $mpesaReceiptNumber, // Replace CheckoutRequestID with actual receipt
                'completed_at' => now(),
            ]);

            Log::info("Donation {$donation->id} marked as completed. Receipt: {$mpesaReceiptNumber}");
        } else {
            // Failed (Cancelled by user, insufficient funds, etc.)
            $donation->update([
                'status' => 'failed',
                'notes' => $data['ResultDesc'] ?? 'Payment failed',
            ]);

            Log::warning("Donation {$donation->id} failed. Reason: " . ($data['ResultDesc'] ?? 'Unknown'));
        }

        return response()->json([
            'ResultCode' => 0,
            'ResultDesc' => 'Success'
        ]);
    }
}
