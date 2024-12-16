<?php

namespace Shopia\Nowpayments;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class Nowpayments
{
    protected $client;
    protected $config;

    public function __construct(array $config = [])
    {
        $this->config = $config;
        $this->initializeClient();
    }

    protected function initializeClient()
    {
        $sandboxMode = $this->config['sandbox_mode'] ?? false;
        $apiKey = $this->config['api_key'] ?? '';
        
        $baseUrl = $sandboxMode
            ? 'https://api-sandbox.nowpayments.io/v1/'
            : 'https://api.nowpayments.io/v1/';

        // Log::info('NowPayments configuration', [
        //     'sandbox_mode' => $sandboxMode,
        //     'base_url' => $baseUrl
        // ]);

        $this->client = new Client([
            'base_uri' => $baseUrl,
            'headers' => [
                'x-api-key' => $apiKey,
                'Content-Type' => 'application/json'
            ]
        ]);
    }

    public function createInvoice(array $data)
    {
        return $this->setHttpResponse('invoice', 'POST', $data);
    }

    public function getPaymentStatus($paymentId)
    {
        return $this->setHttpResponse("payment/{$paymentId}", 'GET');
    }

    public function getCurrencies()
    {
        return $this->setHttpResponse('currencies', 'GET');
    }

    public function getMinimumPaymentAmount($currency_from, $currency_to)
    {
        return $this->setHttpResponse('min-amount', 'GET', [
            'currency_from' => $currency_from,
            'currency_to' => $currency_to
        ]);
    }

    public function getEstimate($amount, $currency_from, $currency_to)
    {
        return $this->setHttpResponse('estimate', 'GET', [
            'amount' => $amount,
            'currency_from' => $currency_from,
            'currency_to' => $currency_to
        ]);
    }

    public function createPayment(array $data)
    {
        return $this->setHttpResponse('payment', 'POST', $data);
    }

    protected function setHttpResponse($url, $method = 'GET', $data = [])
    {
        try {
            $options = [];
            if (!empty($data)) {
                $options['json'] = $data;
            }

            // Log::info('NowPayments request', [
            //     'url' => $url,
            //     'method' => $method,
            //     'data' => $data
            // ]);

            $response = $method === 'GET'
                ? $this->client->get($url, $options)
                : $this->client->post($url, $options);

            $result = json_decode($response->getBody()->getContents(), true);

            // Log::info('NOWPayments response', [
            //     'response' => $result
            // ]);

            return $result;
        } catch (\Exception $e) {
            Log::error('NowPayments request error', [
                'error' => $e->getMessage(),
                'url' => $url,
                'method' => $method
            ]);

            throw $e;
        }
    }
}
