<?php

sendRequest(
    deleteRoomRequest(), 
    deleteRoomArray($_POST['roomname'])
);

require "./controller/v1viewRooms.php";