<?php

// récupérer données de requête HTTP
getContentFromAngular(file_get_contents("php://input"));

// filtrer les entrées

require "./controller/filterInput.php";

// lancer programme switch

switch($_POST['action']) {
    case 'createAccount': 
        require "./controller/v1createAccount.php";
        break;
    case 'connectUser': 
        require "./controller/v1connectUser.php";
        break;
    case 'logOutUser': 
        require "./controller/v1verifyTokenScript.php";
        require "./controller/v1logOutUser.php";
        break;
    case 'createRoom': 
        require "./controller/v1verifyTokenScript.php";
        require "./controller/v1createRoom.php";
        break;
    case 'sendMessage': 
        require "./controller/v1verifyTokenScript.php";
        require "./controller/v1sendMessage.php";
        break;
    case 'viewMessages': 
        require "./controller/v1verifyTokenScript.php";
        require "./controller/v1viewMessages.php";
        break;
    case 'viewRooms': 
        require "./controller/v1verifyTokenScript.php";
        require "./controller/v1viewRooms.php";
        break;
    case 'modifyUserName': 
        require "./controller/v1verifyTokenScript.php";
        require "./controller/v1modifyUserName.php";
        break;
    case 'modifyPassword': 
        require "./controller/v1verifyTokenScript.php";
        require "./controller/v1modifyPassword.php";
        break;
    case 'deleteRoom': 
        require "./controller/v1verifyTokenScript.php";
        require "./controller/v1deleteRoom.php";
        break;
    case 'deleteAccount': 
        require "./controller/v1verifyTokenScript.php";
        require "./controller/v1deleteAccount.php";
        break;
    default: $responseData = ['response' => 'informations incorrectes'];
    sendJsonToAngular($responseData);
    break;
}

