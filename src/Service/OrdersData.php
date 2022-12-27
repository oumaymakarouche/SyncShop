<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class OrdersData
{
    public function __construct(
        private HttpClientInterface $httpClient,
    ) {}
    public function getCommandes(){
        $response = $this->httpClient->request(
            'GET',
            'https://4ebb0152-1174-42f0-ba9b-4d6a69cf93be.mock.pstmn.io/orders',
            [
                'headers' => [
                    'x-api-key' => 'PMAK-62642462da39cd50e9ab4ea7-815e244f4fdea2d2075d8966cac3b7f10b'
                ]
            ]
        )->toArray();
        return $response['results'];
    }
    public function getContacts(){
        $response = $this->httpClient->request(
            'GET',
            'https://4ebb0152-1174-42f0-ba9b-4d6a69cf93be.mock.pstmn.io/contacts',
            [
                'headers' => [
                    'x-api-key' => 'PMAK-62642462da39cd50e9ab4ea7-815e244f4fdea2d2075d8966cac3b7f10b'
                ]
            ]
        )->toArray();
        return $response['results'];
    }
}