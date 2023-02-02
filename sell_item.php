<?php 
	//include("include/dbcon.inc.php");//DB connection
	require_once("ui/jsAlert.ui.php");
	require_once("ui/footer.ui.php");
	require_once("ui/navbar.ui.php");



	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$dbname = "details_db";

	if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname))
	{
		die("Failed to connect!");
	}


	if(isset($_POST['sell']))
	{
		$item_category = $_POST['item_category'];
		$item_name = $_POST['item_name'];
		$quantity = $_POST['quantity'];
		$post_date = $_POST['post_date'];
		$expire_date = $_POST['expire_date'];
		$seller_name = $_POST['seller_name'];
		$description = $_POST['description'];
		$file = $_FILES["image"]["name"];
		$postal_code = $_POST['postal_code'];
		$house = $_POST['house'];
		$street = $_POST['street'];
		$city = $_POST['city'];
		$country = $_POST['country'];
		$price = $_POST['price'];

		

		$image_tem_loc = $_FILES['image']['tmp_name'];
		$image_store = 'image/' .$file;

		move_uploaded_file($image_tem_loc, $image_store);

	
		//}


		$query = "insert into item(item_category, item_name, quantity,post_date, expire_date, seller_name, description, image, postal_code, house, street, city, country, price) values('$item_category', '$item_name', '$quantity', '$post_date', '$expire_date', '$seller_name', '$description', '$file', '$postal_code', '$house', '$street', '$city', '$country', '$price')";

		$query_run = mysqli_query($con,$query);


	


		if($query_run)
		{
			echo '<script type = "text/javascript"> alert("Data uploaded") </script>';
		}
		else
		{
			echo '<script type = "text/javascript"> alert("data not uploaded") </script>';
		}
    


		
		
	}



?>




<!DOCTYPE html>
<html>
	<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Add Item to Sell</title>
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
    <?php showNavBar("index"); // navigation bar ?>
    <div class="container myformcontainer">
        <h3 style="margin-top: 30px;">Sell Your Item Here</h3>
        <br>
        <form method="post" action="sell_item.php">
            <div class="form-group">
            	<input class="form-control" type="text" id="item_category" placeholder="Item Category" name="item_category" required="">

            	&nbsp; &nbsp; &nbsp; &nbsp;

            	<input class="form-control" type="text" id="item_name" placeholder="Item Name" name="item_name" required="">

            	&nbsp; &nbsp; &nbsp; &nbsp;

            	<input class="form-control" type="text" id="quantity" placeholder="Quantity" name="quantity" required="">

            </div>
            
            <div class="form-group">	

            	
            	<input class="form-control" type="text" id="postal_code" placeholder="Postal Code" name="postal_code" required="">

            	&nbsp; &nbsp; &nbsp; &nbsp;

            	<input class="form-control" type="text" id="house" placeholder="House" name="house" required="">

            	&nbsp; &nbsp; &nbsp; &nbsp;

            	<input class="form-control" type="text" id="street" placeholder="Street" name="street" required="">
            </div>

        

            <div class="form-group">

            	<input class="form-control" type="text" id="city" placeholder="City" name="city" required="">

            	&nbsp; &nbsp; &nbsp; &nbsp;

            	<input class="form-control" type="text" id="country" placeholder="Couuntry" name="country" required="">

            	&nbsp; &nbsp; &nbsp; &nbsp;

            	<input class="form-control" type="text" id="price" placeholder="Price" name="price" required="">

            </div>

            <div class="form-group">

            	<input style="width: 173px;" class="form-control" type="date" id="post_date" placeholder="Post Date" name="post_date" required="">
            	<h6 style="color: grey;">Post Date</h6>

            


            	<input style="width: 173px;" class="form-control" type="date" id="expire_date" placeholder="Expire Date" name="expire_date" required="">
            	<h6 style="color: grey;">Expire Date</h6>



            	<input class="form-control" type="text" id="seller_name" placeholder="Perera" name="seller_name" required="">
            </div>
            

          
           <div class="form-group">
            	
            	<input class = "form-control" type = "file" name = "image" id = "image" accept="'.jpg', '.jpeg', '.png'" required />


            	<!--<input type = "file" name = "image2" id = "image2" accept="'.jpg', '.jpeg', '.png'" />-->
           
            </div>

            <!--<div class="form-group">
            	<input type = "file" name = "image3" id = "image3" accept="'.jpg', '.jpeg', '.png'" />
            </div> -->


            <div class="form-group">

            	<input style="height: 100px; width: 590px;" class="form-control" type="text" id="description" placeholder="Description" name="description" required="">

            	<!--<input type = "file" name = "image" id = "image" accept="'.jpg', '.jpeg', '.png'" required="" />-->
            </div>

           

           <!--<div class="form-group">
            	
            	<input class = "form-control" type = "file" name = "image" id = "image" accept="'.jpg', '.jpeg', '.png'" required />

            	<input type = "file" name = "image2" id = "image2" accept="'.jpg', '.jpeg', '.png'" />
           
            </div> -->

            <!--<div class="form-group">
            	<input type = "file" name = "image3" id = "image3" accept="'.jpg', '.jpeg', '.png'" />
            </div> -->


            
            <div class="form-group" style="padding-bottom: 20px;">
            	<button style="color: blue; width: 100px; margin-left: 490px;" class="btn btn-success" id="sell" type="submit" name="sell" style="float:right;"> Upload </button>
            </div>
        </form>
    </div>

    <?php
        showFooter();  //footer 
        showAlert($JSAlertMessage); //if there is any alerts they will be shown
    ?>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>