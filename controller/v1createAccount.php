<?php

if(isset($_POST['username']) 
&& $_POST['username'] !== '' 
&& $_POST['username'] !== 'Profil supprimé' 
&& strlen($_POST['username']) <= 50 
&& strlen($_POST['password']) <= 20 ){

    $responseData = ['response' => 'demande non traitée'];

    $resultFromRequest = readRequest(
        readUserNameRequest(), 
        readUserNameArray( trim($_POST['username']) )
    );

    if($resultFromRequest == true && $resultFromRequest[0]['userName'] === trim($_POST['username']) ){
        $responseData = ['response' => 'ce nom est déjà pris'];
    }
    else{
        
        sendRequest(
            createAccountRequest(), 
            createAccountArray( trim($_POST['username']), generateHashPass($_POST['password']))
        );
        
        $responseData = ['response' => 'compte créé'];
    }

    sendJsonToAngular($responseData);
}

else{
    $responseData = ['response' => 'données non conformes'];
    sendJsonToAngular($responseData);
}
