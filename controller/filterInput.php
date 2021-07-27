<?php

if( isset($_POST['action']) && !(strlen($_POST['action']) <= 100) ){
    $responseData = ['response' => 'Erreur de données'];
    sendJsonToAngular($responseData);
}
if( isset($_POST['username']) && !(strlen($_POST['username']) <= 50) ){
    $responseData = ['response' => 'Identifiant trop long'];
    sendJsonToAngular($responseData);
}
if( isset($_POST['newusername']) && !(strlen($_POST['newusername']) <= 50) ){
    $responseData = ['response' => 'Identifiant trop long'];
    sendJsonToAngular($responseData);
}
if( isset($_POST['password']) && !(strlen($_POST['password']) <= 20) ){
    $responseData = ['response' => 'Mot de passe trop long'];
    sendJsonToAngular($responseData);
}
if( isset($_POST['newpassword']) && !(strlen($_POST['newpassword']) <= 20) ){
    $responseData = ['response' => 'Mot de passe trop long'];
    sendJsonToAngular($responseData);
}
if(isset($_POST['token']) && !(strlen($_POST['token']) <= 100) ){
    $responseData = ['response' => 'Erreur de données'];
    sendJsonToAngular($responseData);
}
if(isset($_POST['target']) && !(strlen($_POST['target']) <= 50) ){
    $responseData = ['response' => 'Nom du destinataire trop long'];
    sendJsonToAngular($responseData);
}
if(isset($_POST['roomname']) && !(strlen($_POST['roomname']) <= 100) ){
    $responseData = ['response' => 'Erreur de données'];
    sendJsonToAngular($responseData);
}
if(isset($_POST['message']) && !(strlen($_POST['message']) <= 500) ){
    $responseData = ['response' => 'Message trop long'];
    sendJsonToAngular($responseData);
}
