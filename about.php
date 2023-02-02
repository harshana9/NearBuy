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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Untitled</title>

</head>

<body>

    <?php showNavBar("index"); // navigation bar ?>

    <div class="container" data-aos="fade-down" style="margin-bottom: 441px;padding-bottom: 465px;margin-top: 24px;">
        <div class="row">
            <div class="col">
                <h1 class="display-5 text-center text-body flex-fill pulse animated">About Us</h1>
                <p class="text-center pulse animated">Do you want to know about the NearBuy Team.</p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="row row-cols-1 row-cols-md-2 mx-auto" style="max-width: 900px;margin-top: 40px;">
                    <div class="col mb-5"><img class="rounded img-fluid shadow" src="assets/img/products/1.jpg" style="margin-top: 3px;padding-top: 0px;"></div>
                    <div class="col d-md-flex align-items-md-end align-items-lg-center mb-5">
                        <div>
                            <h5 class="fw-bold">NearBuy</h5>
                            <p class="text-start text-muted mb-4"><span style="color: rgb(38, 38, 38);">Online Marketplace With Real-Time Alerting System for Traveling Buyers.</span><br><span style="color: black;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Main objective of the system is when a&nbsp;potential customer travelling through an area where an item has posted for sale&nbsp;which he was willing to buy , he will be alerted by the system. Saving time effort and the cost of the&nbsp;users&nbsp;protecting environment by reducing&nbsp;vehicle emissions.</span><br><br><br><br><br></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="row">
                    <div class="col">
                        <h1 class="display-5 text-center" data-aos="fade-up">Our Services</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col" data-bss-hover-animate="bounce">
                        <h1 class="text-center" data-aos="fade-up">Heading</h1>
                        <p class="text-center" data-aos="fade-up">Paragraph</p>
                    </div>
                    <div class="col" data-bss-hover-animate="bounce">
                        <h1 class="text-center" data-aos="fade-up">Heading</h1>
                        <p class="text-center" data-aos="fade-up">Paragraph</p>
                    </div>
                    <div class="col" data-bss-hover-animate="bounce">
                        <h1 class="text-center" data-aos="fade-up">Heading</h1>
                        <p class="text-center">Paragraph</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="row">
                    <div class="col">
                        <h1 class="display-5 text-center" data-aos="fade-up" style="margin-top: 68px;">Contact Us</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col" data-bss-hover-animate="bounce"><img width="384" height="270" style="padding-right: 0px;padding-bottom: 0px;margin-right: 4px;margin-bottom: -4px;" src="assets/img/products/1.jpg"></div>
                    <div class="col" data-bss-hover-animate="bounce" style="padding-right: 151px;">
                        <h1 class="text-start" data-aos="fade-up">Heading</h1>
                        <p class="text-start" data-aos="fade-up">Paragraph</p>
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
    <script src="assets/js/Contact-FormModal-Contact-Form-with-Google-Map.js"></script>
    <script src="assets/js/Multi-step-form.js"></script>
</body>

</html>