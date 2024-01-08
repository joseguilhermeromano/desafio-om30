<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class EnderecoController extends Controller
{
    public function index($cep)
    {
        $cep = "07141040";
        $apiUrl = "http://viacep.com.br/ws/$cep/json";
        $options = [
            'http' => [
                'header' => "Content-Type: application/json",
                'method' => 'GET',
            ],
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
            ],
        ];

        $context = stream_context_create($options);
        $response = file_get_contents($apiUrl, false, $context);

        // Exiba o corpo da resposta
        echo $response;
    }
}
