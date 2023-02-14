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
    <title>AlertMyWishlist</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico"/>
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
    <style type="text/css">
        .btn-light{
            background-color: rgb(179, 255, 204);
        }
        .myContainer{
            padding:10px;
            margin:1px;
        }
    </style>
</head>

<body>

    <?php showNavBar("index"); // navigation bar ?>

    <div id="empresa" class="myContainer">
        <div class="container">
            <div class="row">
                <div class="col-sm-9 col-md-9 col-lg-9">
                    <h2>Buy efficint!</h2>
                    <p>Looking for someting to buy go with nearby, cause it make life easier, efficint and eco-friendly.</p>
                    <a href="register.php" class="btn btn-light btn-lg w-100">Create Wishlist or Search market </a>
                </div>
                <div class="col-sm-3 col-md-3 col-lg-3"><img src="images/buy.jpg"></div>
            </div>
        </div>
    </div>
    <div id="empresa-1" class="myContainer">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 col-md-3 col-lg-3 order-last order-sm-first"><img src="images/sell.jpg"></div>
                <div class="col-sm-9 col-md-9 col-lg-9">
                    <h2>Sell smart!</h2>
                    <p>Dont wait untill your buyers move away. Let them know you are nearby!</p>
                    <a href="sell.php" class="btn btn-light btn-lg w-100">List item for sale</a>
                </div>
            </div>
        </div>
    </div>
    <div id="empresa-2" class="myContainer">
        <div class="container">
            <div class="row">
                <div class="col-sm-9 col-md-9 col-lg-9">
                    <h2>Helthy environment, Better lifestyle!</h2>
                    <p>Nearby makes your day-to-day travles optimized. Reducing travel on same route many times, making you an envronment frendly person.</p>
                    <a href="about.php" class="btn btn-light btn-lg w-100">Learn more...</a>
                </div>
                <div class="col-sm-3 col-md-3 col-lg-3"><img src="images/eco.png"></div>
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