<?php

	//Databse Connection 1
	$db1 = array("database" => "details_db","hostname"=>"localhost", "username"=>"root", "password"=>"");
	
	//Databse Connection 2
	$db2 = array("database" => "epiz_33477931_details_db","hostname"=>"sql210.epizy.com", "username"=>"epiz_33477931", "password"=>"V8wNpvHkvpekcDZ");


	try
	{
		$conn = new PDO("mysql:host=".$db1["hostname"].";dbname=".$db1["database"], $db1["username"],$db1["password"]);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$conn->exec ("SET NAMES utf8");
	}
	catch(PDOException $e)
	{
		//echo $e->getMessage()."--- DB1 Connection failed!<br/>Trying DB2...";
		try
		{
			$conn = new PDO("mysql:host=".$db2["hostname"].";dbname=".$db2["database"], $db2["username"],$db2["password"]);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$conn->exec ("SET NAMES utf8");
		}
		catch(PDOException $e)
		{
			echo $e->getMessage()."--- DB2 Connection failed!";
		}
	}

?>