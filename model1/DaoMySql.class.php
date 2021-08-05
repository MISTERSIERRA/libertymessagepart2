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
			self::$errorDetected[] = $e;
		}
		catch(Exeption $e){
			self::$errorDetected[] = $e;
		}
    }

    static public function sendRequest($requestToPrepare, $arrayExecute) {
		self::launchConnexion();
		
		try{
			// préparer la requête
			$requestPrepare = self::$connexion->prepare($requestToPrepare);

			// exécuter la requête
        	$requestPrepare->execute($arrayExecute);
		}

		catch(PDOExeption $e){
			self::$errorDetected[] = $e;
		}
		catch(Exeption $e){
			self::$errorDetected[] = $e;
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
			self::$errorDetected[] = $e;
		}
		catch(Exeption $e){
			self::$errorDetected[] = $e;
		}

		$requestPrepare->closeCursor();
		self::$connexion=null;
        
        return $resultFromReadRequest;
	}

}