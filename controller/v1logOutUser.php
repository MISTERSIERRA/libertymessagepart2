<?php

sendRequest(
    logoutUserRequest(), 
    logoutUserArray($resultFromRequest[0]['idUser'], generateToken())
);

$responseData = [
    'response' => 'session fermée', 
    'name' => '', 
    'status' => 'nologged', 
    'token' => 'none', 
    'number' => '0'
];

sendJsonToAngular($responseData);
