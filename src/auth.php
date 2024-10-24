<?php

require_once 'api.php';

function handleRegister()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $name = $_POST['name'];
      $password = $_POST['password'];
      $email = $_POST['email'];

      $response = apiRequest('/auth/register', 'POST', [
          'name' => $name,
          'email' => $email,
          'password' => $password
      ]);

      if ($response && isset($response['success']) && $response['success']) {
          $_SESSION['authorization'] = $response['token'];
          $_SESSION['refreshToken'] = $response['refreshToken'];
          $_SESSION['user'] = $response['user'];
          return ['success' => true];
      } else {
          return $response['message'];
      }
  }

  return null;
}

function handleLogin() {
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $response = apiRequest('/auth/login', 'POST', [
        'email' => $email,
        'password' => $password
    ]);

    if ($response && isset($response['token'])) {
        $_SESSION['authorization'] = $response['token'];
        $_SESSION['refreshToken'] = $response['refreshToken'];
        $_SESSION['user'] = $response['user'];
        return ['success' => true];

    } else {
        return $response['message'];
        return 'Error al iniciar sesión.';
    }
  }

  return null;
}
