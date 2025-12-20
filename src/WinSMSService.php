<?php

namespace Shipper\WinSMS;

use GuzzleHttp\Client;

class WinSMSService
{
    protected $apiKey;
    protected $defaultSenderId;
    protected $client;

    public function __construct($apiKey, Client|null $client = null)
    {
        $this->apiKey = $apiKey;
        $this->client = $client ?: new Client();
    }

    public function sendSMS($to, $message)
    {
        $url = 'https://api.winsms.co.za/api/rest/v1/sms/outgoing/send';

        $payload = [
            'message' => $message,
            'recipients' => [
                [
                    'mobileNumber' => $to,
                ]
            ],
            'maxSegments' => 6,
        ];

        $headers = [
            'AUTHORIZATION' => $this->apiKey,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];

        $response = $this->client->post($url, [
            'headers' => $headers,
            'json' => $payload,
        ]);

        return $response->getBody()->getContents();
    }
}
