<?php

function handleRefreshToken()
{
    $response = apiRequest('/auth/refresh-token', 'POST', ['refreshToken' => $_SESSION['refreshToken']], true);
    if ($response && isset($response['token'])) {
        $_SESSION['authorization'] = $response['token'];
        $_SESSION['refreshToken'] = $response['refreshToken'];
        return true;
    }
    $httpCode = isset($http_response_header) ? (int)explode(' ', $http_response_header[0])[1] : 500;
    if ($httpCode === 401) {
        session_destroy();
        throw new Exception('Unauthorized', 401);
    }
}

function apiRequest($endpoint, $method = 'GET', $data = [], $fail = false)
{
    try{
        $url = API_BASE_URL . $endpoint;
        $token = $_SESSION['authorization'] ?? '';
        $options = [
            'http' => [
                'method' => $method,
                'header' => ['Content-Type: application/json', 'Authorization: Bearer ' . $token],
                'content' => json_encode($data),
                'ignore_errors' => true
            ]
        ];
        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);
        $httpCode = isset($http_response_header) ? (int)explode(' ', $http_response_header[0])[1] : 500;
        if ($httpCode === 401 && !$fail) {
            $response = handleRefreshToken();
            if (isset($response)){
                return apiRequest($endpoint, $method, $data);
            }
        }
        if ($httpCode === 401 && isset($fail)) {
            throw new Exception('Unauthorized', 401);
        }
    }catch(Exception $e){
        return [
            'success' => false,
            'code' => $httpCode,
            'message' => $e->getMessage()
        ];
        if ($httpCode === 401) {
            echo "retrhowing exception";
            throw new Exception('Unauthorized', 401);
        }
    }


    return json_decode($response, true);
}
?>