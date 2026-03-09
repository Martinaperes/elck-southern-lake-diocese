<?php

namespace App\Services;

use GuzzleHttp\Client;

class MpesaService
{
    protected $client;
    protected $consumer_key;
    protected $consumer_secret;
    protected $shortcode;
    protected $passkey;
    protected $callback_url;

    protected $baseUrl;

    public function __construct()
    {
        $this->client = new Client();
        $this->consumer_key = env('MPESA_CONSUMER_KEY');
        $this->consumer_secret = env('MPESA_CONSUMER_SECRET');
        $this->shortcode = env('MPESA_SHORTCODE');
        $this->passkey = env('MPESA_PASSKEY');
        $this->callback_url = env('MPESA_CALLBACK_URL');
        $this->baseUrl = env('MPESA_ENV') === 'live' 
            ? 'https://api.safaricom.co.ke' 
            : 'https://sandbox.safaricom.co.ke';
    }

    public function getAccessToken()
    {
        try {
            $response = $this->client->request('GET', $this->baseUrl . '/oauth/v1/generate?grant_type=client_credentials', [
                'auth' => [$this->consumer_key, $this->consumer_secret]
            ]);
            $body = json_decode($response->getBody(), true);
            return $body['access_token'] ?? null;
        } catch (\Exception $e) {
            \Log::error('M-Pesa Access Token Error: ' . $e->getMessage());
            return null;
        }
    }

    public function stkPush($amount, $phone, $accountReference = 'Donation', $transactionDesc = 'Church Donation')
    {
        $token = $this->getAccessToken();
        if (!$token) return ['ResponseCode' => 1, 'CustomerMessage' => 'Failed to generate access token'];

        $timestamp = date('YmdHis');
        $password = base64_encode($this->shortcode . $this->passkey . $timestamp);

        try {
            $response = $this->client->post($this->baseUrl . '/mpesa/stkpush/v1/processrequest', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'BusinessShortCode' => $this->shortcode,
                    'Password' => $password,
                    'Timestamp' => $timestamp,
                    'TransactionType' => 'CustomerPayBillOnline',
                    'Amount' => $amount,
                    'PartyA' => $phone,
                    'PartyB' => $this->shortcode,
                    'PhoneNumber' => $phone,
                    'CallBackURL' => $this->callback_url,
                    'AccountReference' => $accountReference,
                    'TransactionDesc' => $transactionDesc
                ]
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            \Log::error('M-Pesa STK Push Error: ' . $e->getMessage());
            return ['ResponseCode' => 1, 'CustomerMessage' => 'Failed to initiate STK push'];
        }
    }
}
