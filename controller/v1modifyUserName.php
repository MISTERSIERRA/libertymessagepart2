<?php

if(strlen($_POST['newusername']) <= 50){
    $resultFromRequest = readRequest(
        searchUserNameRequest(), 
        searchUserNameArray($_POST['username'])
    );

    if(compareHashPass($_POST['password'], $resultFromRequest[0]['userPass'])){

        $resultFromSecondRequest = readRequest(
            readUserNameRequest(), 
            readUserNameArray( trim($_POST['newusername']) )
        );

        if($resultFromSecondRequest == true && $resultFromSecondRequest[0]['userName'] === trim($_POST['newusername']) ){
            $responseData = ['response' => 'ce nouveau nom est déjà pris'];
        }
        elseif($_POST['newusername'] === '' || $_POST['newusername'] === ' '){
            $responseData = ['response' => 'ce nouveau nom n\'est pas valable'];
        }
        else{
            sendRequest(
                renameUserRequest(), 
                renameUserArray($resultFromRequest[0]['idUser'], trim($_POST['newusername']) )
            );
            $responseData = [
                'response' => 'nom modifié', 
                'number' => $numberConnectFromVerifyToken, 
                'name' => trim($_POST['newusername'])
            ];
        }

    }
    else{
        $responseData = ['response' => 'informations incorrectes'];
    }
}
else{
    $responseData = ['response' => 'informations incorrectes'];
}

sendJsonToAngular($responseData);