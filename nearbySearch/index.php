<?php
//include files
//require_once("include/dbcon.inc.php");
require_once("../ui/navbar.ui.php");
require_once("../ui/footer.ui.php");
//require_once("include/combo.inc.php");
//require_once("ui/spilit_result.ui.php");
require_once("../include/redirect.inc.php");
//require_once("../ui/jsAlert.ui.php");
require_once("../include/loginverify.inc.php");


loginVerify("insidePage");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Nearby Search</title>
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

  <!-- Geocoder things -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>
<body>
  <?php showNavBar("nearbySearch",true); // navigation bar ?>
  <div class="row" style="margin-top: 10px;">
    <div class="col-sm-12 col-md-12 col-lg-12">
      <div class="card m-auto">
        <div class="card-header">
          <font>You are at </font><font id="nowCity1">Loading...</font>, <font id="nowCity2"></font>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-6 mx-auto" id="resultContainer" style="min-height: 100pt;">

            </div>
          </div>
          <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-6 mx-auto" style="padding-bottom: 100pt;">
              <img src='../images/loading.gif' style='width:30pt;margin-left: 48%;'/>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php
      showFooter(true);  //footer 
  ?>

<script>
let city1 = {previous:null, current:null};
let city2 = {previous:null, current:null};
//let results;
let itemIdListOnly=[];
let itemList = [];
//let loading = "<img src='../images/loading.gif' style='width:30pt;margin-left: 48%;'/>";


function getData(nowCity){
	$.ajax('./ajax/sellItems.ajax.php',{
        method: 'POST',
        dataType: 'json',
        data: { city: nowCity },
        success: function (response) {
            //console.log(response);
            handleAjaxResposneOfItems(response);
        },
        error: function (ex) {
            alert(ex.responseText);
        }
    });
}

function reverseGeocode(lat,lng) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        //var arrAddress = this.responseText;//get address fro resulsts
        var data = JSON.parse(this.responseText);
        //console.log(data["results"]);
        var cityLevels=data["results"].length;
        city1.current=data["results"][cityLevels-3]["address_components"][0]["long_name"];
        city2.current=data["results"][cityLevels-4]["address_components"][0]["long_name"];
      }
    };
    xmlhttp.open("GET", "https://maps.googleapis.com/maps/api/geocode/json?latlng=" + lat +"," + lng +"&key=AIzaSyAHgbS3bYYrlyyckvC1tjVn3GB7_0gVnoA", true);
    xmlhttp.send();
}

function handleAjaxResposneOfItems(res){
  //This function handles the ajax php response and work on each item using markSellItem() fucntion dreven by forEach loop
  //console.log(res);
  if(res){
    res.forEach(addToResultList);
  }
}

function addToResultList(item, index){
	//console.log(item);
	if (!(itemIdListOnly.includes(item[0]))) {
	  	itemIdListOnly.push(item[0]);
	  	//itemList.push(item);
		  //console.log(itemList);
      document.getElementById('resultContainer').innerHTML += resultBoxCreater(item[0],item[1],item[2],item[3],item[4]);
      var msgBody = "for "+item[2]+" at "+item[3];
      showNotification(item[1],msgBody)
	}

	//console.log("array is:"+arr);
}

function resultBoxCreater(id,title,city,price,imageSrc){
  let url="./../viewItem.php?item="+id+"&urlBack=nearbySearch&type=row";
  let resultBox = "<div id='" + id + "'>";
    resultBox += "<div class='card bg-light border-primary mb-3'>";
      resultBox += "<div class='card-header'><button type='button' class='btn btn-default btn-sm' onclick='removeNotification(" + id + ")' style='float:right;'>❌</button></div>";
      resultBox += "<a href='" + url + "'><div class='card-body'>";
        resultBox += "<div class='row'>";
          resultBox += "<div class='col-sm-4'>";
            resultBox += "<img src='../" + imageSrc + "' width='100%'/>";
          resultBox += "</div>";
          resultBox += "<div class='col-sm-8'>";
            resultBox += "<font class='card-title' style='font-size: 14pt;font-weight:bold;'>" + title + "</font>";
            resultBox += "<font style='font-size: 9pt;'>&nbsp;&nbsp;@" + city + "</font>";
          resultBox += "<p class='card-text'>LKR. " + price +"</p>";
        resultBox += "</div>";
      resultBox += "</div></a>";
    resultBox += "</div>";
  resultBox += "</div>";

  return resultBox;
}

function successCallback(position){
  lat = position.coords.latitude;
  lng = position.coords.longitude;

  reverseGeocode(lat, lng);

  console.log("latlng : "+lat+", "+lng)

  if(city1.previous!=city1.current){
  	//console.log("City 1 new location: "+city1.current);
    document.getElementById("nowCity1").innerHTML = city1.current;
  	getData(city1.current);
  	/*handleAjaxResposneOfItems(results);
  	city1.previous=city1.current;
  	city1.current=null;*/
  }

  if(city2.previous!=city2.current){
  	//console.log("City 2 new location: "+city2.current);
    document.getElementById("nowCity2").innerHTML = city2.current;
  	getData(city2.current);
  	/*handleAjaxResposneOfItems(results);
  	city2.previous=city2.current;
  	city2.current=null;*/
  }
};

function errorCallback(err){
  console.error(`ERROR(${err.code}): ${err.message}`);
};


navigator.geolocation.watchPosition(successCallback, errorCallback);
//reverseGeocode(6.679401295625881, 80.03576210940265);
</script>

<script type="text/javascript">

  function showNotification(title,body) {
    var icon = "../images/notification-icon.png";
    if (!("Notification" in window)) {
      // Check if the browser supports notifications
      alert("This browser does not support desktop notification");
    } else if (Notification.permission === "granted") {
      // Check whether notification permissions have already been granted;
      // if so, create a notification
      const notification = new Notification(title, { body, icon });
      // …
    } else if (Notification.permission !== "denied") {
      // We need to ask the user for permission
      Notification.requestPermission().then((permission) => {
        // If the user accepts, let's create a notification
        if (permission === "granted") {
          const notification = new Notification(title, { body, icon });
        }
      });
    }
  }
</script>


<!--- UI JS stuff --->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="../assets/js/Contact-FormModal-Contact-Form-with-Google-Map.js"></script>
    <script src="../assets/js/Multi-step-form.js"></script>

    <script type="text/javascript">
      function removeNotification(elmID) {
        var elem = document.getElementById(elmID);
        elem.parentNode.removeChild(elem);
        return false;
      }
    </script>
</body>
</html>