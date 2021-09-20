<?php

namespace version1;

use \version1\DaoMySql;

class TalkToApp {

    static private function sendJsonError($code, $message) {
        http_response_code($code);
        header('Content-Type: application/json');   
        echo json_encode(["success" => false,"error" => $message]);
        die();
    }
    static public function sendJsonToAngular($data) {
        header('Content-Type: application/json');
        echo json_encode($data);
        requestCloseConnexion(); // singleton PDO
        die();
    }
    static public function getContentFromAngular($inputInJsonFormat) {
        $jsonParams = $inputInJsonFormat;
        $decodedParams = json_decode($jsonParams, true);
        if (strlen($jsonParams) > 0 && json_last_error() == JSON_ERROR_NONE) {
            $_POST = $decodedParams;
        }
        if(!isset($_POST)) {
            self::sendJsonError(400, "Bad Request");
        }
        if(isset($_POST) && empty($_POST)) {
            self::sendJsonToAngular(['response' => 'commande non reçue']);
        }
    }

}