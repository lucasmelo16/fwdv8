<?php

header("Access-Control-Allow-Origin: *");
define('fwdv8', 'fwdv');

    function checkRequest() {

        $method = $_SERVER['REQUEST_METHOD'];
        
        switch ($method) {

            case 'PUT':
                $answer = "update";
            break;

            case 'POST':	  
            $answer = "post";
            break;

            case 'GET':
            $answer = "get";
            break;

            case 'DELETE':
            $answer = "delete";
            break;	

            default:
            handle_error($method);  
            break;

        }

        return $answer;
}

$answer = checkRequest();
$request = $_SERVER['REQUEST_URI']; 


$args = explode('/', rtrim($request, '/'));
$endpoint = array_shift($args);

    if (array_key_exists(0, $args) && !is_numeric($args[0])) {

        $verb = array_shift($args);
}

    if ($args) {

	    $request = '/'.fwdv8.'/'.$args[0];
}

    switch ($request) {

        case '/'.fwdv8:
        require __DIR__ . '/api/api.php';
        break;

        case '/'.fwdv8.'/' :
        require __DIR__ . '/api/api.php';
        break;

        case '' :
        require __DIR__ . '/api/api.php';
        break;

        case '/'.fwdv8.'/pessoas' :
        require __DIR__ . '/api/'.$answer.'_pessoa.php';
        break;

        case '/'.fwdv8.'/Jogo' :
        require __DIR__ . '/api/'.$answer.'_Jogo.php';
        break;
    
        default:
        require __DIR__ . '/api/404.php';
        break;
}

?>