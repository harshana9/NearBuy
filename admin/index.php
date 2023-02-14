<?php
    session_start();
    session_unset();
    require_once("../include/dbcon.inc.php");
    //require_once("../ui/footer.ui.php");
    //require_once("../ui/navbar.ui.php");
    require_once("include/loginverify.inc.php");
    require_once("../ui/jsAlert.ui.php");

    $JSAlertMessage=null;
    if(isset($_GET["msg"])){
        $JSAlertMessage=resolveURLmsg($_GET["msg"]);
    }

    $txtUsername=null;
    $txtPassword=null;
    $count=0;
    //$accountStatus=null;
    //$userid=null;

    if(isset($_POST["btnLogin"])){
        $txtUsername=$_POST["txtUsername"];
        $txtPassword=$_POST["txtPassword"];
        
        $sql_quary="SELECT `Admin_ID`, `Password` FROM `admin` WHERE `User_Name`=:User_Name;";
        $sql = $conn->prepare($sql_quary);
        $sql->bindparam(":User_Name",$txtUsername);
        $sql->execute();
        $numRows = $sql->fetchAll();
        if(count($numRows)==1){
            foreach($numRows as $row){
                if(md5($txtPassword)==$row["Password"]){

                    $user_id=$row["Admin_ID"];
                    //$userLname=$row["Last_Name"];
                    $_SESSION["adminID"]=$user_id;
                    //$_SESSION["userLname"]=$userLname;

                    //update last login time
                    $sql_quary="UPDATE `admin` SET `Last_Login`=now() WHERE `Admin_ID`=:user_id;";
                    $sql = $conn->prepare($sql_quary);
                    $sql->bindparam(":user_id",$user_id);
                    $sql->execute(); 
                    $count = $sql->rowCount();

                    if($count==1){
                        loginVerify("login");                        
                    }
                }
                else{
                    $JSAlertMessage="Wrong Password";
                }
            }
        }
        else{
            $JSAlertMessage="Wrong Username";
        }
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>NearBuy - Login</title>
    <link rel="icon" type="image/x-icon" href="../favicon.ico"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="../assets/css/Contact-FormModal-Contact-Form-with-Google-Map.css">
    <link rel="stylesheet" href="../assets/css/Footer-Dark.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="../assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="../assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="../assets/css/Multi-step-form.css">
    <link rel="stylesheet" href="../assets/css/Navigation-with-Button.css">
    <link rel="stylesheet" href="../assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/Navigation-Clean.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <?php //showNavBar("login"); // navigation bar ?>
    <section class="login-clean">
        <form data-bss-disabled-mobile="true" data-aos="slide-up" method="post" action="index.php">
            <h2 class="visually-hidden">Login Form</h2>
            <div class="illustration"><i class="icon ion-ios-navigate"></i></div>
            <div class="mb-3"><input class="form-control" type="text" id="txtUsername" name="txtUsername" placeholder="Username"></div>
            <div class="mb-3"><input class="form-control" type="password" id="txtPassword" name="txtPassword" placeholder="Password"></div>
            <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit" id="btnLogin" name="btnLogin">Log In</button></div>
        </form>
    </section>

    <?php 
        //showFooter(); 
        showAlert($JSAlertMessage);
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="../assets/js/Contact-FormModal-Contact-Form-with-Google-Map.js"></script>
    <script src="../assets/js/Multi-step-form.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>