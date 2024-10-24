<?php
error_reporting(E_ALL); ini_set('display_errors', '1');
require '../config.php';

require '../src/api.php';
require '../src/auth.php';
require '../src/tokens.php';
require '../Router.php';

session_start();

$router = new Router();

function handleSession(){
  if(isset($_SESSION['user'])){
    return true;
  }else {
    return false;
  }
}

$router->add('GET', '/dashboard', function() {
  if (!handleSession() ) {
    header('Location: /login');
    exit();
  }
  $tokens = handleTokenList();
  require '../templates/dashboard.php';
});

$router->add('GET', '/login', function () {
    require '../templates/login.php';
});

$router->add('POST', '/login', function() {
  $loginError = handleLogin();
  if(isset($loginError['success'])){
    header('Location: /dashboard');
    exit();
  }
  if (is_string($loginError)) {
      require '../templates/login.php';
  }
});

$router->add('GET', '/register', function() {
  require '../templates/register.php';
});

$router->add('POST', '/register', function() {
    $registrationError = handleRegister();
    if(isset($registrationError['success'])){
      header('Location: /dashboard');
      exit();
    }
    if (is_string($registrationError)) {
        require '../templates/register.php';
    }
});

$router->add('GET', '/create-token', function (){
  if (!handleSession() ) {
    header('Location: /login');
    exit();
  }
  require '../templates/create-token.php';
});

$router->add('POST', '/create-token', function (){
  if (!handleSession() ) {
    header('Location: /login');
    exit();
  }

  try {
    $tokenError = handleCreateToken();
    if ($tokenError) {
      require '../templates/create-token.php';
    }
  }catch(Exception $e){
    if ($e->getCode() === 401) {
      header('Location: /login');
      exit();
    }
  }
});

$router->add('GET', '/logout', function() {
  session_destroy();
  header('Location: /login');
  exit();
});

$router->add('GET', '/', function () {
  if(isset($_SESSION['user'])){
    echo 'hola';
    header("Location: /dashboard");
    exit();
  }else {
    require '../templates/login.php';
  }
});

$router->run();

?>