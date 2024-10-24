<?php


function handleTokenList()
{
    $tokenLists = apiRequest('/list-tokens', 'GET');
    return $tokenLists['tokens'];
}

function handleCreateToken()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $symbol = $_POST['symbol'];
        $initialSupply = $_POST['initialSupply'];

        $response = apiRequest('/create-token-hederar', 'POST', [
            'name' => $name,
            'symbol' => $symbol,
            'initialSupply' => $initialSupply
        ]);

        if ($response && isset($response['success']) && $response['success']) {
            header('Location: /dashboard');
            exit;
        } else {
            return 'Error al crear el token.';
        }
    }

    return null;
}