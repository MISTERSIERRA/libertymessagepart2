<?php

sendRequest(
    sendMessageRequest(), 
    // sendMessageArray($resultFromRequest[0]['idUser'], $_POST['roomname'], $_POST['message'])
    sendMessageArray($resultFromRequest[0]['idUser'], $_POST['roomname'], cryptText($_POST['message']))
);


require "./controller/v1viewMessages.php";