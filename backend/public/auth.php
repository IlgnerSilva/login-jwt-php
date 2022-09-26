<?php
    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;

    header('Access-Control-Allow-Credentials:true');
    header('Access-Control-Allow-Headers:authorization, content-type, accept, origin');
    header('Access-Control-Allow-Methods:GET, POST, OPTIONS');
    header('Access-Control-Allow-Origin:*');

    $dotenv = Dotenv\Dotenv::createImmutable(dirname(__FILE__, 2));
    $dotenv->load();

    $authorization = $_SERVER['HTTP_AUTHORIZATION'];

    json_encode($authorization);
?>