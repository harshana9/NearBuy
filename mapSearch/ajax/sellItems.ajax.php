<?php
session_start();
require_once("../../include/dbcon.inc.php");

// get the q parameter from URL
$city = $_REQUEST["city"];
$user = $_SESSION["userId"];

/*$city = 'Homagama';
$user = '1';*/

$keywords=array();
$nearbyItems=array();

$sql_quary="SELECT `keyword1`,`keyword2`,`keyword3`,`keyword4` FROM `wishlist` WHERE `User_ID`=:user;";
$sql = $conn->prepare($sql_quary);
$sql->bindparam(':user',$user);
$sql->execute();					
$numRows = $sql->fetchAll();
if(count($numRows)>0){
	foreach($numRows as $row){
		if($row["keyword1"]!=""){
			array_push($keywords,$row["keyword1"]);
		}
		if($row["keyword2"]!=""){
			array_push($keywords,$row["keyword2"]);
		}
		if($row["keyword3"]!=""){
			array_push($keywords,$row["keyword3"]);
		}
		if($row["keyword4"]!=""){
			array_push($keywords,$row["keyword4"]);
		}
	}
}

$sql_quary = "SELECT `Item_ID`,`Item_Title`,`location_lat`,`location_lon`,`price` FROM `item` WHERE `city`=:city AND (1<0";
foreach ($keywords as $keyword) {
	$sql_quary.=" OR `Item_Title` LIKE '%".$keyword."%'";
	$sql_quary.=" OR `Description` LIKE '%".$keyword."%'";
}
$sql_quary.=");";
//echo $sql_quary;
$sql = $conn->prepare($sql_quary);
$sql->bindparam(':city',$city);
$sql->execute();					
$numRows = $sql->fetchAll();
if(count($numRows)>0){
	foreach($numRows as $row){
		$item=array($row["Item_ID"],$row["Item_Title"],$row["location_lat"],$row["location_lon"],$row["price"]);
		array_push($nearbyItems,$item);
	}
}


echo json_encode($nearbyItems);

?>