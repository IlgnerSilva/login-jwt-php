<?php
    require('../vendor/autoload.php');
    define("RelativePath", "..");
    define("PathToCurrentPage", "/public/ ");
    define("FileName", "login.php");
    include_once(RelativePath . "/config/Common.php");
    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;

    header("Access-Control-Allow-Origin: *");

    $dotenv = Dotenv\Dotenv::createImmutable(dirname(__FILE__, 2));
    $dotenv->load();
    
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);  
    
    $db = new clsDBConnection1();
    $sql = "SELECT id, name, email_verify, password FROM users WHERE email_verify = '" . $email . "'";
    $db->query($sql);
    if($db->next_record()) {
        if(md5($password) == $db->f("password")){
            // $teste = array( 'id' => $db->f("id"), 'email' => $db->f("email_verify"), 'name' => $db->f("name"), 'email_enviado' => $email, 'senha' => $db->f('password'));
            // echo json_encode($teste);
            $db->close();
        }else{
            http_response_code(401);
            $db->close();
        }
    }else{
        http_response_code(401);
        $db->close();
    }

    $payload = [
        "exp" => time() + 10,
        "iat" => time(),
        "email" => $email
    ];
    

    $encode = JWT::encode($payload, $_ENV['KEY'], 'HS256');
    echo json_encode($encode);