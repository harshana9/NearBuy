<?php

	$Database = "nearbuy"; //database name
	$Hostname = "localhost";
	$Username = "root";
	$Password = "";


	try
	{
		$conn = new PDO("mysql:host=$Hostname;dbname=$Database", $Username,$Password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$conn->exec ("SET NAMES utf8");
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}

?>