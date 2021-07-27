<?php

if(isset($_POST['username']) 
&& $_POST['username'] !== '' 
&& $_POST['username'] !== 'Profil supprimé' 
&& strlen($_POST['username']) <= 50 
&& strlen($_POST['password']) <= 20 ){

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
else if(!(strlen($_POST['username']) <= 50)){
    $responseData = ['response' => 'Identifiant trop long'];
    sendJsonToAngular($responseData);
}
else if(!(strlen($_POST['password']) <= 20)){
    $responseData = ['response' => 'Mot de passe trop long'];
    sendJsonToAngular($responseData);
}

else{
    $responseData = ['response' => 'données non conformes'];
    sendJsonToAngular($responseData);
}
