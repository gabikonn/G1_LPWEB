<?php

class Banco{

	private static $instance;

	public static function getInstance(){

		if(!isset(self::$instance)){

			try{
				self::$instance = new PDO("mysql:host=localhost; dbname=loja", "root", "");
				self::$instance->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
			} catch (PDOExeption $e) {
				echo $e-> getMessage();
			}		

		}

		return self::$instance;

	}

	public static function prepare($sql){
		return self::getInstance()->prepare($sql);
	}
}