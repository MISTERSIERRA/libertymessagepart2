<?php
header("Access-Control-Allow-Origin: https://mistersierra.github.io");

function sendJsonError($code, $message) {
    http_response_code($code);
    header('Content-Type: application/json');   
    echo json_encode(["success" => false,"error" => $message]);
	die();
}

function sendJson($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
    die();
}

$json_params = file_get_contents("php://input");
$decoded_params = json_decode($json_params, true);

if (strlen($json_params) > 0 && json_last_error() == JSON_ERROR_NONE) {
    $_POST = $decoded_params;
}

if(!isset($_POST)) {
    sendJsonError(400, "Bad Request");
}

if(isset($_POST) && empty($_POST)) {
    sendJson(['response' => 'commande non recue']);
}



// benchmark uniquement
if(isset($_POST) && !empty($_POST)) {
    sendJson($_POST);
}



