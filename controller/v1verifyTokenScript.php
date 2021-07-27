<?php

if(isset($_POST['username']) 
&& $_POST['username'] !== '' 
&& $_POST['username'] !== 'Profil supprimé' 
&& strlen($_POST['username']) <= 50 ){

    $responseData = ['response' => 'demande non traitée'];

    $resultFromRequest = readRequest(
        verifyTokenRequest(), 
        verifyTokenArray($_POST['username'])
    );

    if( $resultFromRequest == true){

        if( verifyToken($resultFromRequest[0]['userConnectToken'], $_POST['token']) ){

            $idUserFromVerifyToken = $resultFromRequest[0]['idUser']; // non utilisé

            $tokenFromVerifyToken = $resultFromRequest[0]['userConnectToken']; // non utilisé

            $numberConnectFromVerifyToken = $resultFromRequest[0]['numberConnect']; // utilisé

            $responseData = ['response' => 'token valide']; // non utilisé

            // sendJsonToAngular($responseData);   // temp 

            // aller au script suivant
        }
        else{
            $responseData = [
                'response' => 'informations incorrectes', 
                'name' => '', 
                'status' => 'nologged', 
                'token' => 'none', 
                'number' => '0'
            ];
            sendJsonToAngular($responseData);
        }

    }
    else{
        $responseData = [
            'response' => 'erreur de connexion', 
            'name' => '', 
            'status' => 'nologged', 
            'token' => 'none', 
            'number' => '0'
        ];
        sendJsonToAngular($responseData);
    }

}
else{
    $responseData = ['response' => 'données non conformes'];
    sendJsonToAngular($responseData);
}
