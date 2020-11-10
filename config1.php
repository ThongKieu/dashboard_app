<?php
// start session
session_start(); 
	// connect to database
        $host = 'localhost:3306';
        $dbname = 'tho59779_12';
        $username = 'tho59_123';
        $password = 'g8&g5n5F';
        $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        try {
          $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password,$options);
          }
          // Catch any errors
          catch (PDOException $e) {
          echo $e->getMessage();
          exit();
          }
  // define global constants
	define ('ROOT_PATH', realpath(dirname(__FILE__))); // path to the root folder
	define ('INCLUDE_PATH', realpath(dirname(__FILE__) . '/includes' )); // Path to includes folder
	define('BASE_URL', 'https://lich.thoviet.com.vn/'); // the home url of the website