<?php

namespace version1;

use \PDO;

class DaoMySql {

    // attributs privés
	static private $host = 'localhost';
	static private $user = 'root'; // root 
    static private $password = ''; // '' 
    static private $bdd = 'libertymessage'; // 'libertymessage' 
    static private $connexion;
	static private $errorDetected = [];


    // connexion à la base de donnée
    static private function launchConnexion() {
		try{
			self::$connexion = new PDO("mysql:host=".self::$host
			.";dbname=".self::$bdd.";charset=utf8", self::$user, self::$password);
			self::$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
		}
		catch(PDOExeption $e){
			self::$errorDetected[] = "Exeption PDO launchConnexion";
		}
		catch(Exeption $e){
			self::$errorDetected[] = "Exeption launchConnexion";
		}
    }

    static public function sendRequest($requestToPrepare, $arrayExecute) {
		self::launchConnexion();
		
		try{
			$requestPrepare = self::$connexion->prepare($requestToPrepare);
        	$requestPrepare->execute($arrayExecute);
		}
		catch(PDOExeption $e){
			self::$errorDetected[] = "Exeption PDO sendRequest";
		}
		catch(Exeption $e){
			self::$errorDetected[] = "Exeption sendRequest";
		}
		
	}

    static public function readRequest($requestToPrepare, $arrayExecute) {
		self::launchConnexion();
		
		try{
			$requestPrepare = self::$connexion->prepare($requestToPrepare);
			$requestPrepare->execute($arrayExecute);
			$resultFromReadRequest = $requestPrepare->fetchAll();
		}
		catch(PDOExeption $e){
			self::$errorDetected[] = "Exeption PDO readRequest";
		}
		catch(Exeption $e){
			self::$errorDetected[] = "Exeption readRequest";
		}

		$requestPrepare->closeCursor();
		self::$connexion=null;
        
        return $resultFromReadRequest;
	}

}