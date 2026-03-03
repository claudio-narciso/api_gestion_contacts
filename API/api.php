<?php 
    use R401\TP5\Utils\Http_response;

    $http_method = $_SERVER['REQUEST_METHOD'];

    switch($http_method) {
        case "GET":
            deliver_response(200, "Ready to go");
            break;
        default:
            deliver_response(400, "Unhandled method");
    }


?>