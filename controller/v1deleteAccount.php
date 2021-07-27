<?php

$resultFromSecondRequest = false;

if( isset($_POST['username']) && strlen($_POST['username']) <= 50 ){
    $resultFromSecondRequest = readRequest(
        searchUserNameRequest(), 
        searchUserNameArray($_POST['username'])
    );
}

if($resultFromSecondRequest == true && compareHashPass($_POST['password'], $resultFromSecondRequest[0]['userPass'])){

    sendRequest(
        deleteUserAccountRequest(), 
        deleteUserAccountArray($resultFromSecondRequest[0]['idUser'])
    );

    $responseData = [
        'response' => 'compte supprimé', 
        'name' => '', 
        'status' => 'nologged', 
        'token' => 'none', 
        'number' => '0'
    ];

}
else{
$responseData = ['response' => 'informations incorrectes'];
}

sendJsonToAngular($responseData);