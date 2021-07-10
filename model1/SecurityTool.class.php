<?php

namespace version1;

class SecurityTool {

	static private $iv="1234567891234567";
	static private $options = 0;
	static private $cryptMethod = 'aes-256-cbc';
	static private $backDoorKey = 'liberty';

	static public function generateToken() {
		return bin2hex(random_bytes(32));
	}

	static public function verifyToken($tokenData, $tokenAngular) {
		return hash_equals($tokenData, $tokenAngular);
	}

	static public function generateHashPass($inputPass) {
		return password_hash($inputPass, PASSWORD_DEFAULT);
	}

	static public function compareHashPass($inputPass, $dataHashPass) {
		return password_verify($inputPass, $dataHashPass);
	}

	static public function cryptText($messageText) {
		return openssl_encrypt($messageText, self::$cryptMethod, self::$backDoorKey, 
		self::$options, self::$iv);
	}

	static public function decryptText($cipherText) {
		return openssl_decrypt($cipherText, self::$cryptMethod, self::$backDoorKey, 
		self::$options, self::$iv);
	}
	
}