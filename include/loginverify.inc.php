<?php
    
    require_once("redirect.inc.php");
    require_once("ui/jsAlert.ui.php");

    //Start session if it is not started yet
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }


    //Verify user account status
    function loginVerify($page=null)
    {
        if(isset($_SESSION["accountStatus"])){
            if($_SESSION["accountStatus"]==1){
                //new account
                if($page!="myaccount"){
                    $msg="Please Complete Your Profile Before get started.";
                    redirect(encyptMsgURL("myaccount.php#profile",$msg));//redirect to complete profile
                }
            }
            elseif($_SESSION["accountStatus"]==2){
                //active account
                //let proceed
                if($page=="login"){
                    redirect("myaccount.php");
                }
            }
            else{
                //someing wrong
                $msg="Someting is Wrong.";
                redirect(encyptMsgURL("login.php", $msg));
            }
        }
        else{
            redirect("login.php");
        }
    }

?>