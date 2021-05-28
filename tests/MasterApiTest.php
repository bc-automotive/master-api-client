<?php

namespace BcAutomotive\MasterApiClient\Tests;

use PHPUnit\Framework\TestCase;
use BcAutomotive\MasterApiClient\MasterApiClient;
use GuzzleHttp\Exception\ClientException;

class MasterApiTest extends TestCase
{


    /**
     * @test
     */
    public function endecryption_test()
    {
        // Setup/prepare the test.
        $apiKey = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNDJjNzM0MmUxMzlmOWE1YTk4NDI1MzBmYjhlOTkwYTk5ODYyMmJlMDNiNDA0MGQ2OTMzZTBiNzg4NGU0OTZiODI1NjI5YjY3YTA2NGY5OTEiLCJpYXQiOjE2MjIxOTQ3OTYuODIwOTI4LCJuYmYiOjE2MjIxOTQ3OTYuODIwOTM0LCJleHAiOjQ3Nzc4NzE5OTYuNzM1NDkzLCJzdWIiOiI5MTMiLCJzY29wZXMiOlsibWFzdGVyLWFwaSJdfQ.Lh6OT-H_pLeOAVEkVOJ1GpfWy13-OREAC8E864RLse-LvUSigaLo-ZiM2ekZ5SMJfJus--B8Vthonj1DVBTlzNDxmQyIXrBEyEO8qKM6xzSAxjltBq6JFpUSJhFuLfr7-qOXINfWCDdXCU2yuoqUdj5K0mNxAOM9kBRRLdd-IobjDutBanzXv8rULR3dbgo7nk8dl_zjNg-nNGbCU2ToYqK6_-fqFFeMk3sNcpaVxoNSlSEOZCNxHGMZWFHKaFvI3EcyxfgFw8s5LMdPKol9EOvQ6cxvgvqaVBemy1pd2ylrEP2jv2HB772h9TbhbL-vP_MnBNgmbttS4X3n7tMAXe7NoTkPqE-QPk-lx3rAitcriYiuWP0U-_-cuwXt0teDAMeqI-KzTI-ArLUf_ksaOqvQnVYKXE1aCtOkOW_cl1dpIRZFsHPhBiIWUooZvrmq8X_VKPwa_RSQB3VDUcktNEkm07cip7ODs05HV9VeoAbFojm7F9-F89ktiTXHjSIefBBa2d_xPey-DvmMdn8takrZtrzppJkF6EbA9lguLaa323-sP4EJR4G0hz7woZLa5Q3QgtkCjKIE2zLf6I1dLD19ESMdNwrbMk4w7I7PGxP14dAy9Vg0jA6n2Jo0a45dYuvog5msAbBNgRB6AS-SCXiSMdA5H1loK2bRHDTsYdU';
        $data = random_bytes(256);
        $name = bin2hex(random_bytes(16));
        $client = new MasterApiClient($apiKey, 'http://master-api.test');

        // Test1: encrypt.
        $enc = $client->encrypt($data, $name);

        // Assert1: encryption response.
        $this->assertIsArray($enc);
        $this->assertArrayHasKey('name', $enc);
        $this->assertArrayHasKey('data', $enc);


        // Test2: decrypt.
        $dec = $client->decrypt($enc['data']);

        // Assert2: decryption response.
        $this->assertIsArray($enc);
        $this->assertArrayHasKey('name', $enc);
        $this->assertArrayHasKey('data', $enc);


        // Assert3: original data == decrypted data.
        $this->assertEquals($name, $dec['name']);
        $this->assertEquals($data, $dec['data']);
    }

    /**
     * @test
     */
    public function auth_failed_test()
    {
        $this->expectException(ClientException::class);

        // Setup/prepare the test.
        $apiKey = bin2hex(random_bytes(16));
        $data = random_bytes(256);
        $name = bin2hex(random_bytes(16));
        $client = new MasterApiClient($apiKey, 'http://master-api.test');
 
        // Test1: encrypt.
        $enc = $client->encrypt($data, $name);
    }

    /**
     * @test
     */
    public function auth_failed2_test()
    {
        $this->expectException(ClientException::class);
        
        // Setup/prepare the test.
        $apiKey = bin2hex(random_bytes(16));
        $data = random_bytes(256);
        $name = bin2hex(random_bytes(16));
        $client = new MasterApiClient($apiKey, 'http://master-api.test');

        // Test2: decrypt.
        $dec = $client->decrypt($data);
    }

}
