<?php

namespace version1;

class RequestSql {



	static public function readUserNameRequest() {
		return "
		SELECT idUser, userName FROM `user` WHERE userName = :userName LIMIT 1;
		";
	}
	static public function readUserNameArray($userName) {
		$arrayExecute = array(':userName' => $userName);
		return $arrayExecute;
	}



	static public function searchUserNameRequest() {
		return "
		SELECT idUser, userName, userPass, userConnectToken, numberConnect  FROM `user` WHERE userName = :userName LIMIT 1;
		";
	}
	static public function searchUserNameArray($userName) {
		$arrayExecute = array(':userName' => $userName);
		return $arrayExecute;
	}



	static public function verifyTokenRequest() {
		return "
		SELECT idUser, userName, userConnectToken, numberConnect  FROM `user` WHERE userName = :userName LIMIT 1;
		";
	}
	static public function verifyTokenArray($userName) {
		$arrayExecute = array(':userName' => $userName);
		return $arrayExecute;
	}



	static public function createAccountRequest() {
		return "
		INSERT INTO `user` 
		(`userName`, `userPass`, `userStatus`, `userDateCreate`, `userDateDelete`, `userConnectToken`, `numberConnect`)  
		VALUES 
		(:userName, :userPass, 'nologged', NOW(), NULL, NULL, 0);
		";
	}
	static public function createAccountArray($userName, $userPassHash) {
		$arrayExecute = array(':userName' => $userName, ':userPass' => $userPassHash);
		return $arrayExecute;
	}



	static public function connectUserRequest() {
		return "
		UPDATE `user` SET  
		`userStatus` = 'logged', 
		`userConnectToken` = :userConnectToken, 
		`numberConnect` = :numberConnect 
		WHERE `idUser` = :idUser LIMIT 1;
		";
	}
	static public function connectUserArray($idUser, $userConnectToken, $numberConnect) {
		$arrayExecute = array(':idUser' => $idUser, ':userConnectToken' => $userConnectToken, 
		':numberConnect' => $numberConnect);
		return $arrayExecute;
	}



	static public function logoutUserRequest() {
		return "
		UPDATE `user` SET  
		`userStatus` = 'nologged', 
		`userConnectToken` = :userConnectToken, 
		`numberConnect` = '0' 
		WHERE `idUser` = :idUser LIMIT 1;
		";
	}
	static public function logoutUserArray($idUser, $userConnectToken) {
		$arrayExecute = array(':idUser' => $idUser, ':userConnectToken' => $userConnectToken);
		return $arrayExecute;
	}



	static public function renameUserRequest() {
		return "
		UPDATE `user` SET `userName` = :userName WHERE `idUser` = :idUser LIMIT 1;
		";
	}
	static public function renameUserArray($idUser, $userName) {
		$arrayExecute = array(':idUser' => $idUser, ':userName' => $userName);
		return $arrayExecute;
	}



	static public function modifyUserPassRequest() {
		return "
		UPDATE `user` SET `userPass` = :userPass WHERE `idUser` = :idUser LIMIT 1;
		";
	}
	static public function modifyUserPassArray($idUser, $userPassHash) {
		$arrayExecute = array(':idUser' => $idUser, ':userPass' => $userPassHash);
		return $arrayExecute;
	}



	static public function deleteUserAccountRequest() {
		return "
		UPDATE `user` SET 
		`userName` = 'Profil supprimé', 
		`userStatus` = 'nologged', 
		`userDateDelete` = NOW(), 
		`userConnectToken` = null, 
		`numberConnect` = '0' 
		WHERE `idUser` = :idUser LIMIT 1;
		";
	}
	static public function deleteUserAccountArray($idUser) {
		$arrayExecute = array(':idUser' => $idUser);
		return $arrayExecute;
	}



	static public function verifyRoomRequest() {
		return "
		SELECT `idRoom` FROM `room` 
		WHERE (`idUserA` = :idUserA AND `idUserB` = :idUserB) 
		OR (`idUserA` = :idUserB AND `idUserB` = :idUserA) LIMIT 1;
		";
	}
	static public function verifyRoomArray($idUserA, $idUserB) {
		$arrayExecute = array(':idUserA' => $idUserA, ':idUserB' => $idUserB);
		return $arrayExecute;
	}



	static public function createRoomRequest() {
		return "
		INSERT INTO `room` 
		(`roomName`, `roomDateCreate`, roomDateLastMessage, `userNameA`,`idUserA`,`userNameB`,`idUserB`) 
		VALUES (:roomName, NOW(), NOW(), :userNameA, :idUserA, :userNameB, :idUserB); 
		SET @lastidroom = (SELECT LAST_INSERT_ID());
		INSERT INTO `access` (`idRoom`, `idUser`) VALUES (@lastidroom, :idUserA); 
		INSERT INTO `access` (`idRoom`, `idUser`) VALUES (@lastidroom, :idUserB); 
		";
	}
	static public function createRoomArray($roomName, $userNameA, $idUserA, $userNameB, $idUserB) {
		$arrayExecute = array(':roomName' => $roomName, ':userNameA' => $userNameA, 
		':idUserA' => $idUserA, ':userNameB' => $userNameB, ':idUserB' => $idUserB);
		return $arrayExecute;
	}



	static public function viewRoomsRequest() {
		return "
		SELECT 
		idUserA, userNameA, 
		idUserB, userNameB, 
		roomName, 
		DATE_FORMAT(roomDateLastMessage, '%d/%m/%y %H:%i:%s') as roomDateLastMessageCustom 
		FROM `user` 
		LEFT JOIN `access` 
		ON `user`.`idUser` = `access`.`idUser` 
		LEFT JOIN `room` 
		ON `access`.`idRoom` = `room`.`idRoom` 
		WHERE `user`.`idUser` = :idUser ORDER BY roomDateLastMessage DESC LIMIT 50;
		";
	}
	static public function viewRoomsArray($idUser) {
		$arrayExecute = array(':idUser' => $idUser);
		return $arrayExecute;
	}



	static public function deleteRoomRequest() {
		return "
		DELETE FROM `room` 
		WHERE roomName = :roomName;
		";
	}
	static public function deleteRoomArray($roomName) {
		$arrayExecute = array(':roomName' => $roomName);
		return $arrayExecute;
	}



	static public function sendMessageRequest() {
		return "
		INSERT INTO `message` 
		(`messageDateCreate`, `author`, `messageText`,`idUser`,`idRoom`) 
		VALUES (
		NOW(), 
		(SELECT userName FROM `user` WHERE idUser = :idUser LIMIT 1), 
		:messageText, 
		:idUser, 
		(SELECT idRoom FROM `room` WHERE roomName = :roomName LIMIT 1)
		);
		UPDATE `room` SET 
		roomDateLastMessage = NOW() 
		WHERE `room`.`roomName` = :roomName;
		";
	}
	static public function sendMessageArray($idUser, $roomName, $messageText) {
		$arrayExecute = array(':idUser' => $idUser, ':roomName' => $roomName, ':messageText' => $messageText);
		return $arrayExecute;
	}
	


	static public function viewMessagesRequest() {
		return "
		SELECT 
		DATE_FORMAT(messageDateCreate, '%d/%m/%y %H:%i:%s') as messageDateCreateCustom, 
		author, 
		messageText 
		FROM `message` 
		WHERE idRoom = (SELECT idRoom FROM `room` WHERE roomName = :roomName LIMIT 1) ORDER BY messageDateCreate DESC LIMIT 100;
		";
	}
	static public function viewMessagesArray($roomName) {
		$arrayExecute = array(':roomName' => $roomName);
		return $arrayExecute;
	}




}