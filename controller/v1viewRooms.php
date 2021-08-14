<?php

$resultFromViewRoomsRequest = readRequest(
    viewRoomsRequest(), 
    viewRoomsArray($resultFromRequest[0]['idUser'])
);

if($resultFromViewRoomsRequest == true){
    for($i1 = 0; $i1 < count($resultFromViewRoomsRequest); $i1++){

        for($i2 = 0; $i2 < count($resultFromViewRoomsRequest[$i1]); $i2++){

            if($resultFromRequest[0]['idUser'] != $resultFromViewRoomsRequest[$i1]['idUserA']){
                $roomlistArray[$i1]['target'] = $resultFromViewRoomsRequest[$i1]['userNameA'];
            }

            elseif($resultFromRequest[0]['idUser'] != $resultFromViewRoomsRequest[$i1]['idUserB']){
                $roomlistArray[$i1]['target'] = $resultFromViewRoomsRequest[$i1]['userNameB'];
            }

            $roomlistArray[$i1]['roomname'] = $resultFromViewRoomsRequest[$i1]['roomName'];
            $roomlistArray[$i1]['datelastmessage'] = $resultFromViewRoomsRequest[$i1]['roomDateLastMessageCustom'];

        }

    }

    $responseData = [
        'response' => 'liste des discussions', 
        'number' => $numberConnectFromVerifyToken, 
        'roomlist' => $roomlistArray
    ];
}

sendJsonToAngular($responseData);