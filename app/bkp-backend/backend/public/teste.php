<?php


// Crie uma instância do cliente Guzzle


// Faça uma requisição GET ao endpoint do ViaCEP
$link = "localhost:8000";
$ip = gethostbyname(parse_url('http://localhost:8000', PHP_URL_HOST));
echo "IP........................".$ip;
$cep = "07141040";
$apiUrl = "https://";
$options = [
    'http' => [
        'method' => 'GET',
        'timeout' => 30
    ],
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
    ]
];

$context = stream_context_create($options);
$response = file_get_contents($apiUrl, false, $context);

// Exiba o corpo da resposta
echo $response;
