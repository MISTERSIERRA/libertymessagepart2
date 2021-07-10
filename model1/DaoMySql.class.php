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

    static public function testDaoMySql() {
		echo "la classe DaoMySql fonctionne bien"."<br>";
	}

    // connexion à la base de donnée
    static private function launchConnexion() {
		self::$connexion = new PDO("mysql:host=".self::$host
    	.";dbname=".self::$bdd.";charset=utf8", self::$user, self::$password);
		// self::$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    }

    static public function sendRequest($requestToPrepare, $arrayExecute) {
		self::launchConnexion();
		
		$requestPrepare = self::$connexion->prepare($requestToPrepare);
        $requestPrepare->execute($arrayExecute);
		
	}

    static public function readRequest($requestToPrepare, $arrayExecute) {
		self::launchConnexion();
		
		$requestPrepare = self::$connexion->prepare($requestToPrepare);
		$requestPrepare->execute($arrayExecute);
		$resultFromReadRequest = $requestPrepare->fetchAll();

		$requestPrepare->closeCursor();
		self::$connexion=null;
        
        return $resultFromReadRequest;
	}



}