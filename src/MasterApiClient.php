<?php

namespace BcAutomotive\MasterApiClient;

use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;

class MasterApiClient
{
    private $guzzle;

    public static function config(array $config = [], GuzzleHttpClient $guzzle = null) {
        static::$client = new static($config, $guzzle);
    }

    public function __construct($apiKey, $url = 'https://api.bflash.eu')
    {
         $this->guzzle = new GuzzleHttpClient([
            'base_uri' => $url.'/api/master/',
            'headers' => [
                'X-Requested-With' => 'XMLHttpRequest',
                'Authorization' => 'Bearer '.$apiKey,
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    public function encrypt($data, $name)
    {
        $response = $this->guzzle->post('encrypt', [
            'json' => [
                'data' => base64_encode($data),
                'name' => $name,
            ]]);

        $json = json_decode($response->getBody());
        $enc = base64_decode($json->data);
        if ($json->hash != sha1($enc)) {
            throw new \Exception('hash mismatch after download');
        }

        return [
            'name' => $name,
            'data' => $enc,
        ];
    }

    public function decrypt($data)
    {
        $response = $this->guzzle->post('decrypt', [
            'json' => [
                'data' => base64_encode($data),
            ]]);

        $json = json_decode($response->getBody());
        $dec = base64_decode($json->data);
        if ($json->hash != sha1($dec)) {
            throw new \Exception('hash mismatch after download');
        }
    
        return [
            'name' => $json->name,
            'data' => $dec,
        ];
    }
}
