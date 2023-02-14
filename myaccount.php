<?php
    session_start();
    require_once("include/dbcon.inc.php");
    require_once("include/loginverify.inc.php");
    require_once("ui/jsAlert.ui.php");
    require_once("ui/footer.ui.php");
    require_once("ui/navbar.ui.php");

    $JSAlertMessage=null;
    if(isset($_GET["msg"])){
        $JSAlertMessage=resolveURLmsg($_GET["msg"]);
    }
    
    loginVerify();

    //Variables

    $profilebodyclass="";
    $activitybodyclass="show active";
    $activitylinkclass="active";
    $profilelinkclass="";
    //$disable="";

    /*if($_SESSION["accountStatus"]==1){
        $profilebodyclass="show active";
        $activitybodyclass="";
        $activitylinkclass="disabled";
        $profilelinkclass="active";
        $disable="aria-disabled=\"true\"";
    }*/
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>NearBuy - MyAccount</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/Bootstrap-Image-Uploader.css">
    <link rel="stylesheet" href="assets/css/Contact-Form-v2-Modal--Full-with-Google-Map.css">
    <link rel="stylesheet" href="assets/css/Contact-FormModal-Contact-Form-with-Google-Map.css">
    <link rel="stylesheet" href="assets/css/dh-row-titile-text-image-right-1.css">
    <link rel="stylesheet" href="assets/css/Footer-Dark.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="assets/css/Ludens-Users---25-After-Register.css">
    <link rel="stylesheet" href="assets/css/Multi-step-form.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Button.css">
    <link rel="stylesheet" href="assets/css/Registration-Form-with-Photo-1.css">
    <link rel="stylesheet" href="assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="assets/css/Search-Input-Responsive-with-Icon.css">
    <link rel="stylesheet" href="assets/css/styles.css">

    <style type="text/css">
        .myTabStyle{
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-top: none;
            border-bottom-left-radius:10px;
            border-bottom-right-radius:10px;
        }
    </style>
</head>

<body>
    <?php showNavBar("myaccount"); // navigation bar ?>
    <div id="empresa" style="padding:20px;margin:1px;">
        <div class="container">
            <div class="row">
                <div>
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item" role="presentation"><a class="nav-link <?php echo $activitylinkclass; ?>" role="tab" data-bs-toggle="tab" href="#myactivity" id="myactivity_link">My Activity</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link <?php echo $profilelinkclass; ?>" role="tab" data-bs-toggle="tab" href="#mywishlist" id="profile_link">Wish List</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link <?php echo $profilelinkclass; ?>" role="tab" data-bs-toggle="tab" href="#addtowishlist" id="profile_link">Add to Wish List</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link <?php echo $profilelinkclass; ?>" role="tab" data-bs-toggle="tab" href="#profile" id="profile_link">My Profile</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane myTabStyle <?php echo $activitybodyclass; ?>" role="tabpanel" id="myactivity">
                            <?php require("myaccount.myactivity.php");
                            //require activity tab body ?>
                        </div>
                        <div class="tab-pane myTabStyle" role="tabpanel" id="mywishlist">
                            <?php require("myaccount.mywishlist.php");
                            //require activity tab body ?>
                        </div>
                        <div class="tab-pane myTabStyle" role="tabpanel" id="addtowishlist">
                            <?php require("myaccount.addtowishlist.php");
                            //require activity tab body ?>
                        </div>
                        <div class="tab-pane myTabStyle" role="tabpanel" id="profile">
                            <?php require("myaccount.profile.php");
                            //require profile tab body ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        showFooter();  //footer 
        showAlert($JSAlertMessage);
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="assets/js/Bootstrap-Image-Uploader.js"></script>
    <script src="assets/js/Contact-FormModal-Contact-Form-with-Google-Map.js"></script>
    <script src="https://geodata.solutions/includes/countrystate.js"></script>
    <script src="assets/js/Multi-step-form.js"></script>
</body>

</html>