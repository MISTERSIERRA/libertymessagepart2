<?php

$resultFromViewMessagesRequest = false;

if(isset($_POST['roomname']) && strlen($_POST['roomname']) <= 100 ){
    $resultFromViewMessagesRequest = readRequest(
    viewMessagesRequest(), 
    viewMessagesArray($_POST['roomname'])
    );
}

if($resultFromViewMessagesRequest == true){
    for($i1 = 0; $i1 < count($resultFromViewMessagesRequest); $i1++){

        for($i2 = 0; $i2 < count($resultFromViewMessagesRequest[$i1]); $i2++){

            $messagelistArray[$i1]['messagedate'] = $resultFromViewMessagesRequest[$i1]['messageDateCreate'];
            $messagelistArray[$i1]['author'] = $resultFromViewMessagesRequest[$i1]['author'];
            $messagelistArray[$i1]['messagetext'] = decryptText($resultFromViewMessagesRequest[$i1]['messageText']);

        }

    }

    $messagelistArrayReverse = array_reverse($messagelistArray, false);

    $responseData = [
        'response' => 'liste des messages', 
        'number' => $numberConnectFromVerifyToken, 
        'messagelist' => $messagelistArrayReverse
    ];
}
else{
    $responseData = ['response' => 'pas de messages'];
}

sendJsonToAngular($responseData);