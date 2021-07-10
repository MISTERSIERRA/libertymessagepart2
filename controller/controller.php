<?php

require "./controller/autoloader.php";


// classe TalkToApp

function sendJsonToAngular($data) {
    return \version1\TalkToApp::sendJsonToAngular($data);
}

function getContentFromAngular($inputInJsonFormat) {
    return \version1\TalkToApp::getContentFromAngular($inputInJsonFormat);
}


// classe SecurityTool

function generateToken() {
    return \version1\SecurityTool::generateToken();
}

function generateHashPass($inputPass) {
    return \version1\SecurityTool::generateHashPass($inputPass);
}

function verifyToken($tokenData, $tokenAngular) {
    return \version1\SecurityTool::verifyToken($tokenData, $tokenAngular);
}

function compareHashPass($inputPass, $dataHashPass) {
    return \version1\SecurityTool::compareHashPass($inputPass, $dataHashPass);
}

function cryptText($messageText) {
    return \version1\SecurityTool::cryptText($messageText);
}
function decryptText($cipherText) {
    return \version1\SecurityTool::decryptText($cipherText);
}


// classe DaoMySql

function sendRequest($requestToPrepare, $arrayExecute) {
    return \version1\DaoMySql::sendRequest($requestToPrepare, $arrayExecute);
}

function readRequest($requestToPrepare, $arrayExecute) {
    return \version1\DaoMySql::readRequest($requestToPrepare, $arrayExecute);
}




// classe RequestSql

function readUserNameRequest() {
    return \version1\RequestSql::readUserNameRequest();
}
function readUserNameArray($userName) {
    return \version1\RequestSql::readUserNameArray($userName);
}

function createAccountRequest() {
    return \version1\RequestSql::createAccountRequest();
}
function createAccountArray($userName, $userPassHash) {
    return \version1\RequestSql::createAccountArray($userName, $userPassHash);
}

function searchUserNameRequest() {
    return \version1\RequestSql::searchUserNameRequest();
}
function searchUserNameArray($userName) {
    return \version1\RequestSql::searchUserNameArray($userName);
}

function verifyTokenRequest() {
    return \version1\RequestSql::verifyTokenRequest();
}
function verifyTokenArray($userName) {
    return \version1\RequestSql::verifyTokenArray($userName);
}

function connectUserRequest() {
    return \version1\RequestSql::connectUserRequest();
}
function connectUserArray($idUser, $userConnectToken, $numberConnect) {
    return \version1\RequestSql::connectUserArray($idUser, $userConnectToken, $numberConnect);
}

function logoutUserRequest() {
    return \version1\RequestSql::logoutUserRequest();
}
function logoutUserArray($idUser, $userConnectToken) {
    return \version1\RequestSql::logoutUserArray($idUser, $userConnectToken);
}

function renameUserRequest() {
    return \version1\RequestSql::renameUserRequest();
}
function renameUserArray($idUser, $userName) {
    return \version1\RequestSql::renameUserArray($idUser, $userName);
}

function modifyUserPassRequest() {
    return \version1\RequestSql::modifyUserPassRequest();
}
function modifyUserPassArray($idUser, $userPassHash) {
    return \version1\RequestSql::modifyUserPassArray($idUser, $userPassHash);
}

function deleteUserAccountRequest() {
    return \version1\RequestSql::deleteUserAccountRequest();
}
function deleteUserAccountArray($idUser) {
    return \version1\RequestSql::deleteUserAccountArray($idUser);
}

function verifyRoomRequest() {
    return \version1\RequestSql::verifyRoomRequest();
}
function verifyRoomArray($idUserA, $idUserB) {
    return \version1\RequestSql::verifyRoomArray($idUserA, $idUserB);
}

function createRoomRequest() {
    return \version1\RequestSql::createRoomRequest();
}
function createRoomArray($roomName, $userNameA, $idUserA, $userNameB, $idUserB) {
    return \version1\RequestSql::createRoomArray($roomName, $userNameA, $idUserA, $userNameB, $idUserB);
}

function viewRoomsRequest() {
    return \version1\RequestSql::viewRoomsRequest();
}
function viewRoomsArray($idUser) {
    return \version1\RequestSql::viewRoomsArray($idUser);
}

function deleteRoomRequest() {
    return \version1\RequestSql::deleteRoomRequest();
}
function deleteRoomArray($roomName) {
    return \version1\RequestSql::deleteRoomArray($roomName);
}

function sendMessageRequest() {
    return \version1\RequestSql::sendMessageRequest();
}
function sendMessageArray($idUser, $roomName, $messageText) {
    return \version1\RequestSql::sendMessageArray($idUser, $roomName, $messageText);
}

function viewMessagesRequest() {
    return \version1\RequestSql::viewMessagesRequest();
}
function viewMessagesArray($roomName) {
    return \version1\RequestSql::viewMessagesArray($roomName);
}

















