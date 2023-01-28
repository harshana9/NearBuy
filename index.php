<?php
    session_start();
    //require_once("db/dbcon.inc.php");
    //require_once("db/loginverify.inc.php");
    require_once("ui/jsAlert.ui.php");
    require_once("ui/footer.ui.php");
    require_once("ui/navbar.ui.php");

    $JSAlertMessage=null;
    if(isset($_GET["msg"])){
        $JSAlertMessage=resolveURLmsg($_GET["msg"]);
    }
    
    //loginVerify();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>DoAcc1.0</title>
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
</head>

<body>

    <?php showNavBar("index"); // navigation bar ?>

    <div id="empresa" style="padding:20px;margin:1px;">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-7 col-lg-7">
                    <h1>Looking for someing to buy?</h1>
                    <p>Description Description DescriptionDescription Description Description Description Description Description&nbsp;</p>
                    <a href="search.php" class="btn btn-light btn-lg w-100">Click here to search</a>
                </div>
                <div class="col-sm-6 col-md-5 col-lg-5"><img src="assets/img/gift-give.png"></div>
            </div>
        </div>
    </div>
    <div id="empresa-1" style="padding:20px;margin:1px;">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-5 col-lg-5"><img src="assets/img/together.png"></div>
                <div class="col-sm-6 col-md-7 col-lg-7">
                    <h1></h1>
                    <p>Description Description DescriptionDescription Description Description Description Description Description&nbsp;</p>
                    <a href="search.php" class="btn btn-light btn-lg w-100">List item for sale</a>
                </div>
            </div>
        </div>
    </div>
    <div id="empresa-2" style="padding:20px;margin:1px;">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-7 col-lg-7">
                    <h1>Who we are</h1>
                    <p>Description Description DescriptionDescription Description Description Description Description Description&nbsp;</p>
                    <a href="about.php" class="btn btn-light btn-lg w-100">Learn more...</a>
                </div>
                <div class="col-sm-6 col-md-5 col-lg-5"><img src="assets/img/flower-give.png"></div>
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
    <script src="assets/js/Contact-FormModal-Contact-Form-with-Google-Map.js"></script>
    <script src="assets/js/Multi-step-form.js"></script>
</body>

</html>