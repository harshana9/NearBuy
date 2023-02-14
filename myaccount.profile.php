<?php
require_once("include/dbcon.inc.php");
require_once("include/combo.inc.php");
//require_once("include/verifyUserPassword.inc.php");
require_once("include/redirect.inc.php");
require_once("ui/jsAlert.ui.php");


//variables
$txtFirstName=null;
$txtLastName=null;
//$txtTelephone=null;
//$ddlGender="";
//$txtDob=null;
$txtNIC=null;
$txtEmail=null;
$txtApartment=null;
$txtStreet=null;
$txtCity=null;
$txtPostalCode=null;
$txtCurruntPassword=null;
$txtNewPassword=null;
$txtConformPassword=null;
$txtCurruntPasswordforDel=null;

//Update
    if(isset($_POST["btnUpdateProfile"])){
        $txtFirstName=$_POST["txtFirstName"];
        $txtLastName=$_POST["txtLastName"];
        //$txtTelephone=$_POST["txtTelephone"];
        //$ddlGender=$_POST["ddlGender"];
        //$txtDob=$_POST["txtDob"];
        $txtNIC=$_POST["txtNIC"];
        $txtEmail=$_POST["txtEmail"];
        $txtApartment=$_POST["txtApartment"];
        $txtStreet=$_POST["txtStreet"];
        $txtCity=$_POST["txtCity"];
        $txtPostalCode=$_POST["txtPostalCode"];


        $sql_quary="UPDATE `users` SET `First_Name`=:user_fname,`Last_Name`=:user_lname,`House`=:user_apartment,`Street`=:user_street,`City`=:user_city,`Postal_Code`=:user_postalcode, `Email`=:user_email, `NIC`=:user_nic WHERE `User_ID`=:user_id;";
        $sql = $conn->prepare($sql_quary);
        $sql->bindparam(":user_fname",$txtFirstName);
        $sql->bindparam(":user_lname",$txtLastName);
        //$sql->bindparam(":user_gender",$ddlGender);
        //$sql->bindparam(":user_dob",$txtDob);
        //$sql->bindparam(":user_contact",$txtTelephone);
        $sql->bindparam(":user_apartment",$txtApartment);
        $sql->bindparam(":user_street",$txtStreet);
        $sql->bindparam(":user_city",$txtCity);
        $sql->bindparam(":user_postalcode",$txtPostalCode);
        $sql->bindparam(":user_email",$txtEmail);
        $sql->bindparam(":user_nic",$txtNIC);
        $sql->bindparam(":user_id",$_SESSION["userId"]);
        $sql->execute();

        $msg="Profile changes Saved. Please Logout and Login again.";
        //redirect(encyptMsgURL("login.php", $msg));
    }

//Retrive
    $sql_quary="SELECT * FROM `users` WHERE `User_ID`=:user_id;";
    $sql = $conn->prepare($sql_quary);
    $sql->bindparam(":user_id",$_SESSION["userId"]);
    $sql->execute();
    $numRows = $sql->fetchAll();
    if(count($numRows)>0){
        foreach($numRows as $row){
            $txtFirstName=$row["First_Name"];
            $txtLastName=$row["Last_Name"];
            //$txtTelephone=$row["user_contact"];
            //$ddlGender=$row["user_gender"];
            //$txtDob=$row["user_dob"];
            $txtEmail=$row["Email"];
            $txtApartment=$row["House"];
            $txtStreet=$row["Street"];
            $txtCity=$row["City"];
            $txtPostalCode=$row["Postal_Code"];
            $txtNIC=$row["NIC"];
        }
    }

//Update Password
    if(isset($_POST["btnUpdatePassword"])){
        $txtCurruntPassword=$_POST["txtCurruntPassword"];
        $txtNewPassword=$_POST["txtNewPassword"];
        $txtConformPassword=$_POST["txtConformPassword"];

        if($txtNewPassword==$txtConformPassword){
            if(verifyUserPassword($txtCurruntPassword,$_SESSION["userId"])){
                $txtNewPassword=md5($txtNewPassword);
                $sql_quary="UPDATE `users` SET `Password`=:user_password WHERE `User_ID`=:user_id;";
                $sql = $conn->prepare($sql_quary);
                $sql->bindparam(":user_password",$txtNewPassword);
                $sql->bindparam(":user_id",$_SESSION["userId"]);
                $sql->execute();

                $JSAlertMessage="Password Updated";
            }
            else{
                $JSAlertMessage="Current password you enterd does not mactch.";
            }
        }
        else{
            $JSAlertMessage="New Password does not macth with Conform feild.";
        }
    }

//delete account
    if(isset($_POST["btnDeleteAccount"])){
        $txtCurruntPasswordforDel=md5($_POST["txtCurruntPasswordforDel"]);

        $sql_quary="UPDATE `doacc_user` SET `user_status`=0 WHERE `user_id`=:user_id AND `Password`=;";
        $sql = $conn->prepare($sql_quary);
        $sql->bindparam(":user_id",$_SESSION["userId"]);
        $sql->execute();
        $count = $sql->rowCount();

        if($count > 0){
            $msg="Account Deleted";
            header("Location: ./index.php");
        }
        else{
            $JSAlertMessage="Password Does not Match.";
        }
    }


?>
    <section class="clean-block clean-form dark h-100">
        <div class="container" style="max-width: 500px;">
            <div class="block-heading" style="padding-top: 10px;">
                <h2 class="text-primary">My Profile<br></h2>
                <p>You can review proflie information here</p>
            </div>
            <form action="myaccount.php#proflie" method="post" enctype="multipart/form-data" role="form">
                <div class="form-group mb-3"><label class="form-label">First Name</label><input class="form-control" type="text" id="txtFirstName" placeholder="First Name" name="txtFirstName" autocomplete="on" value="<?php echo $txtFirstName; ?>" required></div>
                <div class="form-group mb-3"><label class="form-label">Last Name</label><input class="form-control" type="text" id="txtLastName" placeholder="Last Name" name="txtLastName" autocomplete="on" value="<?php echo $txtLastName; ?>" required></div>
                <div class="form-group mb-3"><label class="form-label">NIC</label><input class="form-control" id="txtNIC" type="text" name="txtNIC" value="<?php echo $txtNIC; ?>"></div>
                <div class="form-group mb-3"><label class="form-label">Email</label><input class="form-control" type="email" id="txtEmail" autocomplete="on" placeholder="Email Address" name="txtEmail" disabled value="<?php echo $txtEmail; ?>"></div>
                <div class="form-group mb-3"><label class="form-label">Address</label><input class="form-control" type="text" id="txtApartment" autocomplete="on" placeholder="Apartment/ House" name="txtApartment" value="<?php echo $txtApartment; ?>"><input class="form-control" type="text" id="txtStreet" autocomplete="on" placeholder="Street" name="txtStreet" value="<?php echo $txtStreet; ?>"><input class="form-control" type="text" id="txtCity" autocomplete="on" placeholder="City" name="txtCity" value="<?php echo $txtCity; ?>"><input class="form-control" type="text" id="txtPostalCode" autocomplete="on" placeholder="CityPostal Code" name="txtPostalCode" value="<?php echo $txtPostalCode; ?>"></div>
                <div class="form-group mb-3"><button class="btn btn-primary d-block w-100" type="submit" name="btnUpdateProfile" id="btnUpdateProfile"><i class="fas fa-save"></i>&nbsp;Save Changes</button></div>
                <hr style="margin-top: 30px;margin-bottom: 10px;">



                <h4>Change Password</h4>
                <div class="form-group mb-3"><label class="form-label">Currant Password</label><input class="form-control" type="password" id="txtCurruntPassword-1" name="txtCurruntPassword" placeholder="Currunt Password"></div>
                <div class="form-group mb-3"><label class="form-label">New Password</label><input class="form-control" type="password" id="txtNewPassword" name="txtNewPassword" placeholder="New Password"></div>
                <div class="form-group mb-3"><label class="form-label">Conform Password</label><input class="form-control" type="password" id="txtConformPassword" name="txtConformPassword" placeholder="Retype New Password"></div>
                <div class="form-group mb-3"><button class="btn btn-primary d-block w-100" type="submit" name="btnUpdatePassword"><i class="fas fa-save"></i>&nbsp;Change to New Password</button></div>
                <hr style="margin-top: 30px;margin-bottom: 10px;">



                <h4>Delete Account</h4>
                <div class="form-group mb-3"><label class="form-label">Password</label><input class="form-control" type="password" id="txtCurruntPasswordforDel" name="txtCurruntPasswordforDel" placeholder="Enter Password to Conform Delete"></div>
                <div class="form-group mb-3"><button class="btn btn-primary d-block w-100" type="submit" name="btnDeleteAccount"><i class="fas fa-save"></i>&nbsp;Delete Account</button></div>
            </form>
        </div>
    </section>