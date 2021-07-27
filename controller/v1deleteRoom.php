<?php

if(strlen($_POST['roomname']) <= 100){
    sendRequest(
    deleteRoomRequest(), 
    deleteRoomArray($_POST['roomname'])
    );
}

require "./controller/v1viewRooms.php";