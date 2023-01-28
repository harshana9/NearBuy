<?php
/* 
-----This page Developed By ICT19826 BADD HARSHANA
-----Date - 2023/01/23
-----Page: User Registration
-----Edited - 2023/01/28 (Enhance php code)
*/

//Reuired Modules
require_once("include/dbcon.inc.php");//DB connection
require_once("ui/jsAlert.ui.php");
require_once("ui/footer.ui.php");
require_once("ui/navbar.ui.php");

//This variable Can store one alert message
$JSAlertMessage=null;

//This code Insert new row to user table
if(isset($_POST["register"]))
{
    $userId=null;
    $firstName=$_POST["firstName"];
    $lastName=$_POST["lastName"];
    $nic=$_POST["nic"];
    $email=$_POST["email"];
    $addressLine1=$_POST["addressLine1"];
    $addressLine2=$_POST["addressLine2"];
    $city=$_POST["city"];
    $postalCode=$_POST["postalCode"];
    $country=$_POST["country"];
    $username=$_POST["username"];
    $password=$_POST["password"];
    $conformPassword=$_POST["conformPassword"];
    $telephone=array($_POST["telephone1"],$_POST["telephone2"],$_POST["telephone3"]);

    $proccedInsert=true;

    if($password!=$conformPassword){
        $JSAlertMessage="Password and conform password did not matched!";
        $proccedInsert=false;
    }
    else{
        $password=md5($password);
    }

    if($proccedInsert){
        $quary="INSERT INTO `users`(`User_ID`, `First_Name`, `Last_Name`, `NIC`, `Email`, `House`, `Street`, `City`, `Postal_Code`, `Country`,`User_Name`, `Password`) VALUES (null, :firstName, :lastName, :nic, :email, :addressLine1, :addressLine2, :city, :postalCode, :country, :username, :password);";
        $sql = $conn->prepare($quary);
        $sql->bindparam(":firstName",$firstName);
        $sql->bindparam(":lastName",$lastName);
        $sql->bindparam(":nic",$nic);
        $sql->bindparam(":email",$email);
        $sql->bindparam(":addressLine1",$addressLine1);
        $sql->bindparam(":addressLine2",$addressLine2);
        $sql->bindparam(":city",$city);
        $sql->bindparam(":postalCode",$postalCode);
        $sql->bindparam(":country",$country);
        $sql->bindparam(":username",$username);
        $sql->bindparam(":password",$password);
        $sql->bindparam(":lastName",$lastName);
        $sql->execute();
        $userId = $conn->lastInsertId();

        if($userId!=null){
            foreach ($telephone as $value) {
                if($value!=""){
                    $quary="INSERT INTO `telephone`(`User_ID`, `Telephone_Number`) VALUES (:userId, :telephone)";
                    $sql = $conn->prepare($quary);
                    $sql->bindparam(":userId",$userId);
                    $sql->bindparam(":telephone",$value);
                    $sql->execute();

                }
            }
            $JSAlertMessage="User Account Created!";
        }
    }

}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Contact-FormModal-Contact-Form-with-Google-Map.css">
    <link rel="stylesheet" href="assets/css/dh-row-titile-text-image-right-1.css">
    <link rel="stylesheet" href="assets/css/Footer-Dark.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="assets/css/Multi-step-form.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Button.css">
    <link rel="stylesheet" href="assets/css/Registration-Form-with-Photo-1.css">
    <link rel="stylesheet" href="assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="assets/css/Search-Input-Responsive-with-Icon.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" type="text/css" href="assets/css/mystyles.css">
</head>

<body>
    <?php showNavBar("index"); // navigation bar ?>
    <div class="container myformcontainer">
        <h3 style="margin-top: 20px;">Register for new account</h3>
        <form method="post" action="register.php">
            <div class="form-group"><label>First Name</label><input class="form-control" type="text" id="firstName" placeholder="Samantha" name="firstName" required=""></div>
            <div class="form-group"><label>Last Name</label><input class="form-control" type="text" id="lastName" placeholder="Perera" name="lastName" required=""></div>
            <div class="form-group"><label>NIC</label><input class="form-control" type="text" id="nic" placeholder="198813005647" name="nic" required=""></div>
            <div class="form-group"><label>Email</label><input class="form-control" type="email" name="email" placeholder="samantha@email.com" required=""></div>
            <div class="form-group"><label>Address</label><input class="form-control" type="text" id="addressLine1" placeholder="No. 45" name="addressLine1" required=""><input class="form-control" type="text" id="addressLine2" placeholder="School Lane" name="addressLine2" required="" style="margin-top:2px;"><input class="form-control" type="text" id="city" placeholder="Homagama" name="city" required="Homagama" style="margin-top:2px;"><input class="form-control" type="text" id="postalCode" placeholder="12456" name="postalCode" required="" style="margin-top:2px;"><input class="form-control" type="text" id="country" name="country" required="" style="margin-top:2px;" value="Sri Lanka"></div>
            <div class="form-group"><label>Username</label><input class="form-control" type="text" id="username" placeholder="a Unique name for your account" name="username" required=""></div>
            <div class="form-group"><label>Password</label><input class="form-control" type="password" id="password" placeholder="Should contain letters and numbers" required="" name="password"><input class="form-control" type="password" id="conformPassword" placeholder="Retype Password" required="" name="conformPassword" style="margin-top:2px;"></div>
            <div class="form-group"><label>Telephone</label><input class="form-control" type="number" id="telephone1" name="telephone1" required="" placeholder="0771234567"><input class="form-control" type="number" id="telephone2" name="telephone2" placeholder="Another number (Optional)" style="margin-top:2px;"><input class="form-control" type="number" id="telephone3" name="telephone3" placeholder="Another number (Optional)" style="margin-top:2px;"></div>
            <div class="form-group" style="padding-bottom: 20px;"><button class="btn btn-success" id="register" type="submit" name="register" style="float:right;">Create Account</button><button class="btn btn-link" type="reset">Reset</button></div>
        </form>
    </div>

    <?php
        showFooter();  //footer 
        showAlert($JSAlertMessage); //if there is any alerts they will be shown
    ?>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>