<?php

namespace App\Services;

use GuzzleHttp\Client;

class CnpjService
{
    private $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'https://brasilapi.com.br/api/']);
    }

    public function buscarCnpj($cnpj)
    {
        $response = $this->client->get("cnpj/v1/{$cnpj}");
        return json_decode($response->getBody(), true);
    }
}
