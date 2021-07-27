<?php

if(strlen($_POST['newpassword']) <= 20){
    $resultFromSecondRequest = readRequest(
    searchUserNameRequest(), 
    searchUserNameArray($_POST['username'])
    );

    if(compareHashPass($_POST['password'], $resultFromSecondRequest[0]['userPass'])){

            sendRequest(
                modifyUserPassRequest(), 
                modifyUserPassArray($resultFromSecondRequest[0]['idUser'], generateHashPass($_POST['newpassword']))
            );

            $responseData = [
                'response' => 'mot de passe modifié', 
                'number' => $numberConnectFromVerifyToken
            ];

    }
    else{
        $responseData = ['response' => 'informations incorrectes'];
    }
}
else{
    $responseData = ['response' => 'informations incorrectes'];
}

sendJsonToAngular($responseData);