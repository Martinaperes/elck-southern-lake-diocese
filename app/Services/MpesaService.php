<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class MpesaService
{
    protected $client;
    protected $config;
    protected $baseUrl;

    public function __construct()
    {
        $this->client = new Client();
        $this->config = config('mpesa');
        
        $this->baseUrl = ($this->config['env'] ?? 'sandbox') === 'live' 
            ? 'https://api.safaricom.co.ke' 
            : 'https://sandbox.safaricom.co.ke';
    }

    /**
     * Log M-Pesa events for debugging and tracking
     */
    protected function logEvent($label, $data = []) {
        Log::info("M-PESA [{$label}]", $data);
    }

    public function getAccessToken()
    {
        try {
            $response = $this->client->request('GET', $this->baseUrl . '/oauth/v1/generate?grant_type=client_credentials', [
                'auth' => [$this->config['consumer_key'], $this->config['consumer_secret']]
            ]);
            
            $body = json_decode($response->getBody(), true);
            $token = $body['access_token'] ?? null;
            
            if (!$token) {
                $this->logEvent('TOKEN_FAILED', $body);
            }
            
            return $token;
        } catch (\Exception $e) {
            $this->logEvent('TOKEN_ERROR', ['msg' => $e->getMessage()]);
            return null;
        }
    }

    public function stkPush($amount, $phone, $accountReference = 'Donation', $transactionDesc = 'Church Donation', $transactionType = 'CustomerPayBillOnline')
    {
        $token = $this->getAccessToken();
        if (!$token) return ['ResponseCode' => 1, 'CustomerMessage' => 'M-Pesa Authentication failed'];

        $timestamp = date('YmdHis');
        $password = base64_encode($this->config['shortcode'] . $this->config['passkey'] . $timestamp);

        $payload = [
            'BusinessShortCode' => $this->config['shortcode'],
            'Password' => $password,
            'Timestamp' => $timestamp,
            'TransactionType' => $transactionType,
            'Amount' => (int)$amount,
            'PartyA' => $phone,
            'PartyB' => $this->config['shortcode'],
            'PhoneNumber' => $phone,
            'CallBackURL' => $this->config['callback_url'],
            'AccountReference' => $accountReference,
            'TransactionDesc' => $transactionDesc
        ];

        $this->logEvent('STK_REQUEST_SENT', $payload);

        try {
            $response = $this->client->post($this->baseUrl . '/mpesa/stkpush/v1/processrequest', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json',
                ],
                'json' => $payload
            ]);

            $result = json_decode($response->getBody(), true);
            $this->logEvent('STK_RESPONSE_RECEIVED', $result);
            
            return $result;
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            $response = $e->getResponse();
            $body = $response ? json_decode($response->getBody(), true) : null;
            
            $this->logEvent('STK_API_ERROR', [
                'status' => $response ? $response->getStatusCode() : 'No Response',
                'body' => $body,
                'msg' => $e->getMessage()
            ]);

            return [
                'ResponseCode' => 1, 
                'CustomerMessage' => $body['errorMessage'] ?? 'M-Pesa API Error (Status: ' . ($response ? $response->getStatusCode() : 'Unknown') . ')'
            ];
        } catch (\Exception $e) {
            $this->logEvent('STK_FATAL_ERROR', ['msg' => $e->getMessage()]);
            return ['ResponseCode' => 1, 'CustomerMessage' => 'Failed to connect to M-Pesa. Please check your configuration.'];
        }
    }

    public function verifyTransaction($checkoutRequestId)
    {
        $this->logEvent('VERIFY_REQUEST_INITIATED', ['checkout_request_id' => $checkoutRequestId]);

        try {
            $response = $this->client->post($this->config['verify_url'], [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'checkout_request_id' => $checkoutRequestId
                ]
            ]);

            $result = json_decode($response->getBody(), true);
            $this->logEvent('VERIFY_RESPONSE_RECEIVED', $result);
            
            return $result;
        } catch (\Exception $e) {
            $this->logEvent('VERIFY_FATAL_ERROR', ['msg' => $e->getMessage()]);
            return ['status' => 'error', 'message' => 'Unable to verify payment status at this moment.'];
        }
    }
}
