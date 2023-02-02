<?php
	include("include/dbcon.inc.php");//DB connection
	require_once("ui/jsAlert.ui.php");
	require_once("ui/footer.ui.php");
	require_once("ui/navbar.ui.php");
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	    <title>Search Item</title>
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

	    <style>
	    	table{
	    		display: flex;
	    	}
	    </style>
	</head>
	<body>

		<?php showNavBar("index"); ?>

		<h1 style="color: green; text-align: center;"> Find Item Here </h1><br>

		<div class="py-5">
			<div class="container">
				<div class="row">
					<div class="col-md-12"></div>
				</div>
			</div>
		</div>

		<form action = "search.php" method="POST">

			<input type = "text" name = "Category" id = "Category" placeholder="Category Name" required="">

			<input style="color: blue;" type = "submit" name = "go" value = "View" /><br>



			<br><br><br>

			<div class = "row">
		

				<?php

				$dbhost = "localhost";
					//$dbuserid = "";
					$dbuser = "root";
					$dbpass = "";
					$dbname = "details_db";

					if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname))
					{
						die("Failed to connect!");
					}


					if(isset($_POST['go'])){

						$office_id = $_POST['Category'];

						$sql = "select * from item where item_category = '$office_id'";
			
						($query = mysqli_query($con,$sql));


						while($row = mysqli_fetch_array($query)){

							?>

							<div class="col-md-3 mb-2">


										<h5><a href="view.php?&ui=<?php echo $row['item_ID']; ?>">
											<div class="card shadow">
												<div class="card-body">

													<img src = "c.jpg"/>

													<h5>Item Name: <?php echo $row['item_ID']?> </h5>

													<h5>Item Name: <?php echo $row['item_name']?> </h5>

													<h5>Quantity: <?php echo $row['City']?> </h5>

											
												</div>
											</div>

										

										</a> </h5>
									
						</div>

							<?php
						}

					




				
					}

					else{

						$sql = "select * from item";
			
						($query = mysqli_query($con,$sql));


						while($row = mysqli_fetch_array($query)){

							?>

							<div class="col-md-3 mb-2">


										<h5><a href="view.php?&ui=<?php echo $row['item_ID']; ?>">
											<div class="card shadow">
												<div class="card-body">

													<img src = "c.jpg"/>

													<h5>Item Name: <?php echo $row['item_ID']?> </h5>

													<h5>Item Name: <?php echo $row['item_name']?> </h5>

													<h5>Quantity: <?php echo $row['City']?> </h5>

											
												</div>
											</div>

										

										</a> </h5>
									
						</div>

						<?php

					}
				}

					
				?>





			</div> 

		</form>

		 <?php
        showFooter();  //footer 
        showAlert($JSAlertMessage); //if there is any alerts they will be shown
    ?>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>


	</body>
</html>