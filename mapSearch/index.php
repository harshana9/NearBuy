<?php
    session_start();
    require_once("../include/dbcon.inc.php");
    require_once("../include/loginverify.inc.php");
    require_once("../ui/footer.ui.php");
    require_once("../ui/navbar.ui.php");

    loginVerify("insidePage");
?>
<html>
  <head>
    <title>NearBuy - Map Search</title>
    <link rel="icon" type="image/x-icon" href="../favicon.ico"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="../assets/css/Contact-FormModal-Contact-Form-with-Google-Map.css">
    <link rel="stylesheet" href="../assets/css/dh-row-titile-text-image-right-1.css">
    <link rel="stylesheet" href="../assets/css/Footer-Dark.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="../assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="../assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="../assets/css/Multi-step-form.css">
    <link rel="stylesheet" href="../assets/css/Navigation-with-Button.css">
    <link rel="stylesheet" href="../assets/css/Registration-Form-with-Photo-1.css">
    <link rel="stylesheet" href="../assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="../assets/css/Search-Input-Responsive-with-Icon.css">
    <link rel="stylesheet" href="../assets/css/styles.css">

    <!--Things for map-->

    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <style type="text/css">
      .searchBox{
        padding: 4pt;
        margin: 4pt;
        margin-top: 8pt;
        border-radius: 6pt;
        height: 30pt;
        font-size: 12pt;
      }
    </style>
    <link rel="stylesheet" type="text/css" href="./style.css" />
    <script type="module" src="./index.js"></script>
  </head>
  <body>
    <?php showNavBar("mapSearch",true); // navigation bar ?>
    <input
      id="pac-input"
      class="controls searchBox"
      type="text"
      placeholder="Search Area you to check for your wishlist"
    />
    <div id="map"></div>

    <?php
        showFooter(true);  //footer 
    ?>

    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHgbS3bYYrlyyckvC1tjVn3GB7_0gVnoA&callback=initAutocomplete&libraries=places&v=weekly"
      async
      defer
    ></script>

    <!-- UI JS stuff --->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
  </body>
</html>