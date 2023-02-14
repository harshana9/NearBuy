<?php
    
    //require_once("redirect.inc.php");
    //'require_once("ui/jsAlert.ui.php");

    //Start session if it is not started yet
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }


    //Verify user account status
    function loginVerify($status=null)
    {
        if(isset($_SESSION["userId"])){
            if($status=="login"){
                header("Location: ./index.php");
            }
        }
        else{
            if($status=="insidePage"){
                header("Location: ./../login.php");
            }
            else{
                header("Location: ./login.php");
            }
        }
    }

?>