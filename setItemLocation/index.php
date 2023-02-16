<?php
    session_start();
    require_once("../include/dbcon.inc.php");
    //require_once("db/loginverify.inc.php");
    require_once("../ui/footer.ui.php");
    require_once("../ui/navbar.ui.php");

    loginVerify("insidePage");

    $txtLat=null;
    $txtLng=null;
    $txtCity=null;
    $txtItemId=null;

    if(isset($_GET["itemId"])){
        if($_GET["itemId"]!=""){
            $txtItemId=$_GET["itemId"];
        }
    }

    if(isset($_POST["saveLocation"])){
        $txtLat=$_POST["txtLat"];
        $txtLng=$_POST["txtLng"];
        $txtCity=$_POST["txtCity"];
        $txtItemId=$_POST["txtItemId"];

        $sql_quary="UPDATE `item` SET `location_lat`=:location_lat ,`location_lon`=:location_lon, `city`=:city WHERE `Item_ID`=:item_id;";
        $sql = $conn->prepare($sql_quary);
        $sql->bindparam(":location_lat",$txtLat);
        $sql->bindparam(":location_lon",$txtLng);
        $sql->bindparam(":city",$txtCity);
        $sql->bindparam(":item_id",$txtItemId);
        $sql->execute();

        header("Location: ./../index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>NearBuy</title>
    <link rel="icon" type="image/x-icon" href="../favicon.ico"/>
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
    <link rel="stylesheet" type="text/css" href="./style.css" />
    <script type="module" src="./index.js"></script>
</head>

<body>

    <?php showNavBar("sell"); // navigation bar ?>


    <div id="map"></div>


    <div id="empresa" style="padding:20px;margin:1px;">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <form method="post" action="index.php">
                      <input type="hidden" name="txtLat" id="txtLat" value="" />
                      <input type="hidden" name="txtLng" id="txtLng" value="" />
                      <input type="hidden" name="txtCity" id="txtCity" value="" />
                      <input type="hidden" name="txtItemId" id="txtItemId" value="<?php echo $txtItemId; ?>" />
                      <font style="font-weight:bold;">*Please mark the location of the item on map and click on `save item location`.</font>
                      <input type="submit" name="saveLocation" id="saveLocation" value="Save Item Location" class="btn btn-success" style="float: right;" />
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
        showFooter(true);  //footer 
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="../assets/js/Contact-FormModal-Contact-Form-with-Google-Map.js"></script>
    <script src="../assets/js/Multi-step-form.js"></script>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHgbS3bYYrlyyckvC1tjVn3GB7_0gVnoA&callback=mapStart&v=weekly"
      defer
    ></script>
</body>

</html>