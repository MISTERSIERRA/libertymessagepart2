<?php

$resultFromSecondRequest = false;

if(isset($_POST['target']) && strlen($_POST['target']) <= 50 ){
    $resultFromSecondRequest = readRequest(
    readUserNameRequest(), 
    readUserNameArray( trim($_POST['target']) )
    );
}

if($resultFromSecondRequest == true && $resultFromSecondRequest[0]['userName'] === trim($_POST['target']) ){

    $resultFromThirdRequest = readRequest(
        verifyRoomRequest(), 
        verifyRoomArray($resultFromRequest[0]['idUser'], $resultFromSecondRequest[0]['idUser'])
    );

    if(isset($resultFromThirdRequest[0]['idRoom'])){
        $responseData = ['response' => 'cette discussion existe déjà'];
        sendJsonToAngular($responseData);
    }
    else{

        sendRequest(
            createRoomRequest(), 
            createRoomArray(generateToken(), 
            $resultFromRequest[0]['userName'], 
            $resultFromRequest[0]['idUser'], 
            $resultFromSecondRequest[0]['userName'], 
            $resultFromSecondRequest[0]['idUser'])
        );

        require "./controller/v1viewRooms.php";
        
    }

}
else{
    $responseData = ['response' => 'informations incorrectes'];
    sendJsonToAngular($responseData);
}

