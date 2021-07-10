<?php

$resultFromViewMessagesRequest = readRequest(
    viewMessagesRequest(), 
    viewMessagesArray($_POST['roomname'])
);

if($resultFromViewMessagesRequest == true){
    for($i1 = 0; $i1 < count($resultFromViewMessagesRequest); $i1++){

        for($i2 = 0; $i2 < count($resultFromViewMessagesRequest[$i1]); $i2++){

            $messagelistArray[$i1]['messagedate'] = $resultFromViewMessagesRequest[$i1]['messageDateCreate'];
            $messagelistArray[$i1]['author'] = $resultFromViewMessagesRequest[$i1]['author'];
            $messagelistArray[$i1]['messagetext'] = decryptText($resultFromViewMessagesRequest[$i1]['messageText']);

        }

    }

    $responseData = [
        'response' => 'liste des messages', 
        'number' => $numberConnectFromVerifyToken, 
        'messagelist' => $messagelistArray
    ];
}
else{
    $responseData = ['response' => 'erreur de lecture des messages'];
}

sendJsonToAngular($responseData);