<?php

if(isset($_POST['username']) 
&& $_POST['username'] !== '' 
&& $_POST['username'] !== 'Profil supprimé'){

    $responseData = ['response' => 'demande non traitée'];

    $resultFromRequest = readRequest(
        searchUserNameRequest(), 
        searchUserNameArray($_POST['username'])
    );

    if($resultFromRequest == true && $resultFromRequest[0]['userName'] === $_POST['username']){
        
        if(compareHashPass($_POST['password'], $resultFromRequest[0]['userPass'])){

            if(!$resultFromRequest[0]['userConnectToken']){
                $responseData['token'] = generateToken();
            } 
            else{
                $responseData['token'] = $resultFromRequest[0]['userConnectToken'];
            }

            $responseData['number'] = strval(intval($resultFromRequest[0]['numberConnect']) + 1);
            $responseData['response'] = 'vous êtes connecté';
            $responseData['name'] = $_POST['username'];
            $responseData['status'] = 'logged';

            sendRequest(
                connectUserRequest(), 
                connectUserArray($resultFromRequest[0]['idUser'], 
                $responseData['token'], $responseData['number'])
            );

        }
        else{
            $responseData = ['response' => 'informations incorrectes'];
        }
    }
    else{
        $responseData = ['response' => 'informations incorrectes'];
    }

    sendJsonToAngular($responseData);
}
else{
    $responseData = ['response' => 'données non conformes'];
    sendJsonToAngular($responseData);
}
