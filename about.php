<?php
    require_once("ui/jsAlert.ui.php");
    require_once("ui/footer.ui.php");
    require_once("ui/navbar.ui.php");

    $JSAlertMessage=null;
    if(isset($_GET["msg"])){
        $JSAlertMessage=resolveURLmsg($_GET["msg"]);
    }

    if(isset($_GET["urlBack"])){
        $urlBack=resolveURLmsg($_GET["urlBack"]);
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>AlertMyWishlist -About</title>
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
    <?php showNavBar("about"); // navigation bar ?>
    <div id="empresa" style="padding:20px;margin:1px;">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <img src="images/fullLogoTransparent.png">
                        </div>
                        <div class="card-body" style="text-align:center;">
                            <h4 class="card-title">About</h4>
                            <h6 class="text-muted card-subtitle mb-2">Naerby is a C2C and B2C online marketplace</h6>
                            <p class="card-text">Online Marketplace With Real-Time Alerting System for Traveling Buyers.</span><br><span style="color: black;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Main objective of the system is when a&nbsp;potential customer travelling through an area where an item has posted for sale&nbsp;which he was willing to buy , he will be alerted by the system. Saving time effort and the cost of the&nbsp;users&nbsp;protecting environment by reducing&nbsp;vehicle emissions.<br/><br/><u>Contact us</u><br><b>Email : </b>admin@alertMyWishlist.rf.gd<br><br></p><a class="btn btn-primary" onclick="history.back()">OK</a>
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