<?php
//include files
require_once("include/dbcon.inc.php");
require_once("ui/navbar.ui.php");
require_once("ui/footer.ui.php");
require_once("include/redirect.inc.php");
require_once("ui/jsAlert.ui.php");
require_once("include/loginverify.inc.php");

    $JSAlertMessage=null;
    loginVerify();

    //Varibales
    $ItemId=null;
    $Item_Title=null;
    $Description=null;
    $Post_Date=null;
    $city=null;
    $location_unavailable=false;
    $location_lat=7.8731;
    $location_lon=80.7718;
    $contact_name=null;
    $contact1=null;
    $contact2=null;
    $contact3=null;
    $price=null;
    $category_name=null;
    $arrImages=array();

    if(isset($_GET["item"])){


        if(isset($_GET["type"])){
            if($_GET["type"]){
                $ItemId=$_GET["item"];
                if(isset($_GET["urlBack"])){
                    $urlBack=$_GET["urlBack"];
                }
            }
        }
        else{
            $ItemId=resolveURLmsg($_GET["item"]);
            if(isset($_GET["urlBack"])){
                $urlBack=resolveURLmsg($_GET["urlBack"]);
            }

        }
        

        $sql_quary="SELECT DISTINCT `Item_ID`, `Item_Title`, `Description`, `Post_Date`, `city`, `location_lat`, `location_lon`, `price`, `contact_name`, `contact1`, `contact2`, `contact3`, `item_image`, `category_name` FROM `item` LEFT JOIN `itemcategory` ON `itemcategory`.`Category_ID`=`itemcategory`.`Category_ID` LEFT JOIN `item_image` ON `item`.`Item_ID`=`item_image`.`item_image_item_id` WHERE `Item_ID`=:item;";
        $sql = $conn->prepare($sql_quary);
        $sql->bindparam(":item",$ItemId);
        $sql->execute();
        $numRows = $sql->fetchAll();
        if(count($numRows)>0){
            foreach($numRows as $row){
                $Item_Title=$row["Item_Title"];
                $Description=$row["Description"];
                $Post_Date=$row["Post_Date"];
                $city=$row["city"];
                $location_lat=$row["location_lat"];
                $location_lon=$row["location_lon"];
                $contact_name=$row["contact_name"];
                $contact1=$row["contact1"];
                $contact2=$row["contact2"];
                $contact3=$row["contact3"];
                $price=$row["price"];
                $category_name=$row["category_name"];
                if($row["location_lat"]=="" || $row["location_lon"]==""){
                    $location_unavailable=true;
                }
                break;
            }

            foreach($numRows as $row){
                array_push($arrImages,$row["item_image"]);
            }
        }
    }
    else{
        header("Location: ./index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>NearBuy - View Item</title>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.8/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="assets/css/Ludens-Users---25-After-Register.css">
    <link rel="stylesheet" href="assets/css/Multi-step-form.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Button.css">
    <link rel="stylesheet" href="assets/css/Registration-Form-with-Photo-1.css">
    <link rel="stylesheet" href="assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="assets/css/Search-Input-Responsive-with-Icon.css">
    <link rel="stylesheet" href="assets/css/Simple-Slider.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <style type="text/css">
    	.slide-image{
    		background-size: contain !important;
		    background-repeat: no-repeat;
		    background-position: center center; 
		    max-height: 300px !important;
    	}
        .info-descriptions{
            padding-left: 40px;
        }
        .card-text{
            padding-left: 20px;
        }
    </style>

    <!------- Map things ---->
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <style type="text/css">
        /* 
         * Always set the map height explicitly to define the size of the div element
         * that contains the map. 
         */
        #map {
          height: 100%;
        }

        /* 
         * Optional: Makes the sample page fill the window. 
         */
        html,
        body {
          height: 100%;
          margin: 0;
          padding: 0;
        }
    </style>
</head>
<body>
	<?php showNavBar(""); // navigation bar ?>

    <div id="empresa-1" style="padding:20px;margin:1px;width: 100%;">
        <div class="container">
            <div class="row">
                <div class="col-sm-7 col-md-7 col-lg-7 mx-auto">
                    <a class="btn btn-warning" style="margin:3px;" href="<?php echo $urlBack; ?>">Go Back</a><br/>
                    <div class="card">
				        <div class="card-body">
				            <h4 class="card-title"><?php echo $Item_Title; ?></h4>
                            <h6 class="muted card-subtitle mb-2" style="font-weight: normal;"><b>Posted </b> <?php echo $Post_Date; ?><br/><b>Currunty at </b><?php echo $city; ?></h6>
				            <div class="simple-slider">
				                <div class="swiper-container">
				                    <div class="swiper-wrapper">
				                    	<?php
				                    		foreach($arrImages as $img){
				                    			echo "<div class=\"swiper-slide slide-image\" style=\"background-image: url('".$img."');\"></div>";
				                    		}
				                    	?>
				                    </div>
				                    <div class="swiper-pagination"></div>
				                    <div class="swiper-button-prev"></div>
				                    <div class="swiper-button-next"></div>
				                </div>
				            </div>
				            <h5 class="card-subtitle mb-2" style="margin-top: 12px;">Item Details</h5>
				            <p class="card-text">
                                <b>Category: </b><?php echo $category_name; ?><br/>
                                <b>Price: </b><?php echo $price; ?><br/>
                                <b>Description: </b><br/><font class="info-descriptions"><?php echo $Description; ?></font>
                            </p>
                            <h5 class="card-subtitle mb-2">Contact Info</h5>
                            <p class="card-text">
                                <b>Contact Name: </b><?php echo $contact_name; ?><br/>
                                <b>Contact Number(s): </b><br/>
                                <font style="padding-left: 30px;"><?php echo $contact1; ?></font><br/>
                                <?php if($contact2!=""){ ?>
                                    <font style="padding-left: 30px;"><?php echo $contact2; ?></font><br/>
                                <?php } ?>
                                <?php if($contact3!=""){ ?>
                                    <font style="padding-left: 30px;"><?php echo $contact3; ?></font><br/>
                                <?php } ?>
                            </p>
                            <h5 class="card-subtitle mb-2">Location</h5>
                            <font color="red"><?php if($location_unavailable){ echo "*Location is not available!"; } ?></font>
                            <div id="map" style="width:95%; height: 320px; max-height: 75%;"></div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.8/swiper-bundle.min.js"></script>
    <script src="https://geodata.solutions/includes/countrystate.js"></script>
    <script src="assets/js/Multi-step-form.js"></script>
    <script src="assets/js/Simple-Slider.js"></script>

    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHgbS3bYYrlyyckvC1tjVn3GB7_0gVnoA&callback=initMap&v=weekly"
      defer
    ></script>

    <script type="text/javascript">
        function initMap() {
          const myLatLng = { lat: <?php echo $location_lat; ?>, lng:  <?php echo $location_lon; ?> };
          const map = new google.maps.Map(document.getElementById("map"), {
            zoom: <?php if(!($location_unavailable)){ echo 15; }else{ echo 4; } ?>,
            center: myLatLng,
          });

          new google.maps.Marker({
            position: myLatLng,
            map,
            title: "<?php echo $Item_Title; ?>",
          });
        }

        window.initMap = initMap;
            </script>
</body>
</html>