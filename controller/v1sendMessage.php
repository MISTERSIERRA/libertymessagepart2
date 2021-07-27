<?php

if(strlen($_POST['message']) <= 500){
	sendRequest(
    sendMessageRequest(), 
    sendMessageArray($resultFromRequest[0]['idUser'], $_POST['roomname'], cryptText($_POST['message']))
	);
}


require "./controller/v1viewMessages.php";