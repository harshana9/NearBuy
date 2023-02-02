<?php
	//include("include/dbcon.inc.php");//DB connection
	require_once("ui/jsAlert.ui.php");
	require_once("ui/footer.ui.php");
	require_once("ui/navbar.ui.php");

	$dbhost = "localhost";
					//$dbuserid = "";
					$dbuser = "root";
					$dbpass = "";
					$dbname = "details_db";

					if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname))
					{
						die("Failed to connect!");
					}

	$ui = $_GET['ui'];

	
			?>

			<!DOCTYPE html>
			<html>
				<head>
					<meta charset="utf-8">
				    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
				    <title>View Item</title>
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
				    <link rel="stylesheet" type="text/css" href="assets/css/mystyles.css">
				</head>
				<body>

					<?php showNavBar("index"); ?>

					<br>
					<br>

					<div class="container">
						<div class="row">

							<?php

								$sql = "select * from item where item_ID = '$ui'";
			
								($query = mysqli_query($con,$sql));


								while($row = mysqli_fetch_array($query)){

									?>



							<div class="col-md-4">
								<img src="c.jpg" class="w-100">
							</div>
							<div class="col-md-8">
			

								<h5>Item Name: <?php echo $row['item_ID']?> </h5> 

								<hr>

								<h5>Item Name: <?php echo $row['item_name']?> </h5>

								<hr>

								<h5>Price: <?php echo $row['Price']?> </h5>

								<hr>

								<h5>Quantity: <?php echo $row['quantity']?> </h5>

								<hr>

								<h5>Post Date: <?php echo $row['post_date']?> </h5>

								<hr>
										
								<h5>Expire Date: <?php echo $row['expire_date']?> </h5>

								<hr>

								<h5>Seller Name: <?php echo $row['seller_name']?> </h5>

								<hr>

								<h5>Description: <?php echo $row['description']?> </h5>

								<hr>

								<h5>Postal Code: <?php echo $row['postal_code']?> </h5>


								<h5>House: <?php echo $row['House']?> </h5>


								<h5>Street: <?php echo $row['Street']?> </h5>


								<h5>City: <?php echo $row['City']?> </h5>


								<h5>Country: <?php echo $row['Country']?> </h5>

								<hr>

													
							</div>
							<?php
						}
						?>
						</div>
					</div>

					 <?php
        showFooter();  //footer 
        showAlert($JSAlertMessage); //if there is any alerts they will be shown
    ?>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>

				</body>
			</html>











