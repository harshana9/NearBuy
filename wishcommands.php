<?php
session_start();
require_once("include/dbcon.inc.php");
require_once("include/combo.inc.php");
//require_once("include/verifyUserPassword.inc.php");
require_once("include/redirect.inc.php");
require_once("ui/jsAlert.ui.php");


//variables
$mgs=null;
$txtName=null;
$txtKeyword1=null;
$txtKeyword2=null;
$txtKeyword3=null;
$txtKeyword4=null;

if(isset($_POST["AddToWishlist"])){
    $txtName=$_POST["Title"];
    $txtKeyword1=$_POST["txtKeyword1"];
    $txtKeyword2=$_POST["txtKeyword2"];
    $txtKeyword3=$_POST["txtKeyword3"];
    $txtKeyword4=$_POST["txtKeyword4"];

    $sql_quary="INSERT INTO `wishlist`(`User_ID`, `Name`, `Keyword1`, `Keyword2`, `Keyword3`, `Keyword4`) VALUES (:User_ID, :Name, :Keyword1, :Keyword2, :Keyword3, :Keyword4);";
    $sql = $conn->prepare($sql_quary);
    $sql->bindparam(":User_ID",$_SESSION["userId"]);
    $sql->bindparam(":Name",$txtName);
    $sql->bindparam(":Keyword1",$txtKeyword1);
    $sql->bindparam(":Keyword2",$txtKeyword2);
    $sql->bindparam(":Keyword3",$txtKeyword3);
    $sql->bindparam(":Keyword4",$txtKeyword4);
    $sql->execute();
    $count = $sql->rowCount();

    if($count > 0){
        header('Location: myaccount.php');
    }
}

//delete
if(isset($_GET["WishDel"])){
    $Wish_ID=$_GET["WishDel"];

    $sql_quary="DELETE FROM `wishlist` WHERE `Wish_ID`=:Wish_ID AND `User_ID`=:User_ID;";
    $sql = $conn->prepare($sql_quary);
    $sql->bindparam(":Wish_ID",$Wish_ID);
    $sql->bindparam(":User_ID",$_SESSION["userId"]);
    $sql->execute();
    $count = $sql->rowCount();

    header("Location: myaccount.php");
}


?>