<?php

if(isset($_POST['username']) 
&& $_POST['username'] !== '' 
&& $_POST['username'] !== 'Profil supprimé' 
&& strlen($_POST['username']) <= 100 
&& strlen($_POST['password']) <= 200 ){

    $responseData = ['response' => 'demande non traitée'];

    $resultFromRequest = readRequest(
        readUserNameRequest(), 
        readUserNameArray($_POST['username'])
    );

    if($resultFromRequest == true && $resultFromRequest[0]['userName'] === $_POST['username']){
        $responseData = ['response' => 'ce nom est déjà pris'];
    }
    else{
        
        sendRequest(
            createAccountRequest(), 
            createAccountArray($_POST['username'], generateHashPass($_POST['password']))
        );
        
        $responseData = ['response' => 'compte créé'];
    }

    sendJsonToAngular($responseData);
}
else{
    $responseData = ['response' => 'données non conformes'];
    sendJsonToAngular($responseData);
}
