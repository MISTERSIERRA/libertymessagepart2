<?php

// récupérer données de requête Angular
// transférer les données vers variable POST
getContentFromAngular(file_get_contents("php://input"));


// lancer programme switch

switch($_POST['action']) {
    case 'createAccount': 
        require "./controller/v1createAccount.php"; // ok
        break;
    case 'connectUser': 
        require "./controller/v1connectUser.php"; // ok
        break;
    case 'logOutUser': 
        require "./controller/v1verifyTokenScript.php";
        require "./controller/v1logOutUser.php"; // ok
        break;
    case 'createRoom': 
        require "./controller/v1verifyTokenScript.php";
        require "./controller/v1createRoom.php"; // ok
        break;
    case 'sendMessage': 
        require "./controller/v1verifyTokenScript.php";
        require "./controller/v1sendMessage.php"; // ok 
        break;
    case 'viewMessages': 
        require "./controller/v1verifyTokenScript.php";
        require "./controller/v1viewMessages.php"; // ok number
        break;
    case 'viewRooms': 
        require "./controller/v1verifyTokenScript.php";
        require "./controller/v1viewRooms.php"; // ok number
        break;
    case 'modifyUserName': 
        require "./controller/v1verifyTokenScript.php";
        require "./controller/v1modifyUserName.php"; // ok number
        break;
    case 'modifyPassword': 
        require "./controller/v1verifyTokenScript.php";
        require "./controller/v1modifyPassword.php"; // ok number
        break;
    case 'deleteRoom': 
        require "./controller/v1verifyTokenScript.php";
        require "./controller/v1deleteRoom.php"; // ok
        break;
    case 'deleteAccount': 
        require "./controller/v1verifyTokenScript.php";
        require "./controller/v1deleteAccount.php"; // ok
        break;
    default: $responseData = ['response' => 'informations incorrectes'];
    sendJsonToAngular($responseData);
    break;
}

