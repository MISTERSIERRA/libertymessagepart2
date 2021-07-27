<?php

// ajouter condition
if(strlen($_POST['newusername']) <= 50){
    $resultFromRequest = readRequest(
        searchUserNameRequest(), 
        searchUserNameArray($_POST['username'])
    );

    if(compareHashPass($_POST['password'], $resultFromRequest[0]['userPass'])){

        $resultFromSecondRequest = readRequest(
            readUserNameRequest(), 
            readUserNameArray($_POST['newusername'])
        );

        if($resultFromSecondRequest == true && $resultFromSecondRequest[0]['userName'] === $_POST['newusername']){
            $responseData = ['response' => 'ce nouveau nom est déjà pris'];
        }
        elseif($_POST['newusername'] === '' || $_POST['newusername'] === ' '){
            $responseData = ['response' => 'ce nouveau n\'est pas valable'];
        }
        else{
            sendRequest(
                renameUserRequest(), 
                renameUserArray($resultFromRequest[0]['idUser'], $_POST['newusername'])
            );
            $responseData = [
                'response' => 'nom modifié', 
                'number' => $numberConnectFromVerifyToken, 
                'name' => $_POST['newusername']
            ];
        }

    }
}
else if(!(strlen($_POST['newusername']) <= 50)){
    $responseData = ['response' => 'Identifiant trop long'];
}
else{
    $responseData = ['response' => 'informations incorrectes'];
}

sendJsonToAngular($responseData);