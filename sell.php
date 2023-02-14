<?php
    session_start();
    require_once("include/dbcon.inc.php");
    require_once("include/loginverify.inc.php");
    require_once("ui/jsAlert.ui.php");
    require_once("ui/footer.ui.php");
    require_once("ui/navbar.ui.php");
    require_once("include/combo.inc.php");
    require_once("imageUploader/uploader.inc.php");

    $JSAlertMessage=null;
    if(isset($_GET["msg"])){
        $JSAlertMessage=resolveURLmsg($_GET["msg"]);
    }
    
    loginVerify();


    //Varibales
    $itemId=null;

    $txtTitle=null;
    $ddlCategory=null;
    //$ddlCondition=null;
    $txtDescription=null;
    //$ddlDelveryOption=null;
    //$txtDelveryDescription=null;
    $txtContactName=null;
    $txtContactNumber=null;
    $txtContactNumber2=null;
    $txtContactNumber3=null;
    $txtPrice=null;
    //$txtEmail=null;
    $arrImages=array();

    $submitBtnName="btnSubmitItem";

//Retrive For Edit
    if(isset($_GET["edit"])){
        $itemId=resolveURLmsg($_GET["edit"]);

        $submitBtnName="btnUpdateItem";

        $sql_quary="SELECT * FROM `doacc_item` LEFT JOIN `doacc_item_image` ON `doacc_item`.`item_id` = `doacc_item_image`.`item_image_item_id` WHERE `doacc_item`.`item_id`=:item_id AND `item_user_id`=:item_user_id;";
        $sql = $conn->prepare($sql_quary);
        $sql->bindparam(":item_id",$itemId);
        $sql->bindparam(":item_user_id",$_SESSION["userId"]);
        $sql->execute();
        $numRows = $sql->fetchAll();
        if(count($numRows)>0){
            foreach($numRows as $row){
                $txtTitle=$row["item_name"];
                $ddlCategory=$row["item_categoryid"];
                //$ddlCondition=$row["item_contitionid"];
                $txtDescription=$row["item_description"];
                $ddlDelveryOption=$row["item_deliveryoptionid"];
                $txtDelveryDescription=$row["item_deliverydescription"];
                $txtContactName=$row["item_contactname"];
                $txtContactNumber=$row["item_contactnumber1"];
                $txtContactNumber2=$row["item_contactnumber2"];
                $txtContactNumber3=$row["item_contactnumber3"];
                $txtEmail=$row["item_contactemail"];
                $arrImages=array();
                break;
            }
            foreach($numRows as $row){
                array_push($arrImages, $row["item_image"]);
            }
        }
        else{
            $msg="Unusual activity ditedted. Try Login again.";
            redirect(encyptMsgURL("login.php",$msg));
        }
    }


//Insert
    if(isset($_POST["btnSubmitItem"])){
        $txtTitle=$_POST["txtTitle"];
        $ddlCategory=$_POST["ddlCategory"];
        //$ddlCondition=$_POST["ddlCondition"];
        $txtDescription=$_POST["txtDescription"];
        //$ddlDelveryOption=$_POST["ddlDelveryOption"];
        //$txtDelveryDescription=$_POST["txtDelveryDescription"];
        $txtContactName=$_POST["txtContactName"];
        $txtContactNumber=$_POST["txtContactNumber"];
        $txtContactNumber2=$_POST["txtContactNumber2"];
        $txtContactNumber3=$_POST["txtContactNumber3"];
        $txtPrice=$_POST["txtPrice"];
        //$txtEmail=$_POST["txtEmail"];

        $sql_quary="INSERT INTO `item`(`Item_Title`, `Description`, `Post_Date`, `Expire_Date`, `Category_ID`, `User_ID`, `price`, `contact_name`, `contact1`, `contact2`, `contact3`) VALUES (:item_name, :item_description, curdate(), DATE_ADD(curdate(), INTERVAL 1 MONTH), :item_categoryid, :item_user_id, :price, :item_contactname, :item_contactnumber1, :item_contactnumber2, :item_contactnumber3);";
        $sql = $conn->prepare($sql_quary);


        $sql->bindparam(":item_name",$txtTitle);
        $sql->bindparam(":item_description",$txtDescription);
        $sql->bindparam(":item_categoryid",$ddlCategory);

        //$sql->bindparam(":item_user_id",$ui);//Temp
        $sql->bindparam(":item_user_id",$_SESSION["userId"]);

        //$sql->bindparam(":item_contitionid",$ddlCondition);
        $sql->bindparam(":price",$txtPrice);
        //$sql->bindparam(":item_deliverydescription",$txtDelveryDescription);
        $sql->bindparam(":item_contactname",$txtContactName);
        $sql->bindparam(":item_contactnumber1",$txtContactNumber);
        $sql->bindparam(":item_contactnumber2",$txtContactNumber2);
        $sql->bindparam(":item_contactnumber3",$txtContactNumber3);
        //$sql->bindparam(":item_contactemail",$txtEmail);
        $sql->execute();
        $itemId = $conn->lastInsertId();

        $msg="Your ad is under review. It will be posted soon.";

        $uploadPaths=upload(array("img1","img2","img3"),$itemId,$_FILES);
        if(count($uploadPaths)>0){
            foreach ($uploadPaths as $image) {
                $sql_quary="INSERT INTO `item_image`(`item_image_item_id`, `item_image`) VALUES (:item_image_item_id,:item_image);";
                $sql = $conn->prepare($sql_quary);
                $sql->bindparam(":item_image_item_id",$itemId);
                $sql->bindparam(":item_image",$image);
                $sql->execute();
            }
        }
        else{
            $msg="Images not uploaded. You can retry to uplod them by visting my account page and edit the item.";
        }

        header("Location: ./setItemLocation/index.php?itemId=".$itemId);
        //redirect(encyptMsgURL("myaccount.php",$msg));
    }

//Update
    if(isset($_POST["btnUpdateItem"])){
        $itemId=$_POST["hidItemId"];
        $txtTitle=$_POST["txtTitle"];
        $ddlCategory=$_POST["ddlCategory"];
        $ddlCondition=$_POST["ddlCondition"];
        $txtDescription=$_POST["txtDescription"];
        $ddlDelveryOption=$_POST["ddlDelveryOption"];
        $txtDelveryDescription=$_POST["txtDelveryDescription"];
        $txtContactName=$_POST["txtContactName"];
        $txtContactNumber=$_POST["txtContactNumber"];
        $txtContactNumber2=$_POST["txtContactNumber2"];
        $txtContactNumber3=$_POST["txtContactNumber3"];
        $txtEmail=$_POST["txtEmail"];
        $hidimg1Cleard=$_POST["hidimg1Cleard"];
        $hidimg2Cleard=$_POST["hidimg2Cleard"];
        $hidimg3Cleard=$_POST["hidimg3Cleard"];

        //Update Images
            //Delete Cleard Itmes
            $deletedFiles=array();
            $deletedFiles=deletefilesAtUpdate(array($hidimg1Cleard,$hidimg2Cleard,$hidimg3Cleard));
            //Delete Database Image Paths
            if(count($deletedFiles)>0){
                foreach ($deletedFiles as $image) {
                    echo "SQLLL".$itemId."@".$image;
                    $sql_quary="DELETE FROM `doacc_item_image` WHERE `item_image_item_id`=:item_image_item_id AND `item_image`=:item_image;";
                    $sql = $conn->prepare($sql_quary);
                    $sql->bindparam(":item_image_item_id",$itemId);
                    $sql->bindparam(":item_image",$image);
                    $sql->execute();
                }
            }
            //Insert and Upload Newly Selected Images
            $uploadPaths=upload(array("img1","img2","img3"),$itemId,$_FILES);
            if(count($uploadPaths)>0){
                foreach ($uploadPaths as $image) {
                    $sql_quary="INSERT INTO `doacc_item_image`(`item_image_item_id`, `item_image`) VALUES (:item_image_item_id,:item_image);";
                    $sql = $conn->prepare($sql_quary);
                    $sql->bindparam(":item_image_item_id",$itemId);
                    $sql->bindparam(":item_image",$image);
                    $sql->execute();
                }
            }

        //Update Item
        $sql_quary="UPDATE `doacc_item` SET `item_categoryid`=:item_categoryid,`item_name`=:item_name,`item_contitionid`=:item_contitionid,`item_description`=:item_description,`item_deliveryoptionid`=:item_deliveryoptionid,`item_deliverydescription`=:item_deliverydescription,`item_contactname`=:item_contactname,`item_contactnumber1`=:item_contactnumber1,`item_contactnumber2`=:item_contactnumber2,`item_contactnumber3`=:item_contactnumber3,`item_contactemail`=:item_contactemail,`item_statuscode`=0 WHERE `item_id`=:item_id AND `item_user_id`=:item_user_id;";
        $sql = $conn->prepare($sql_quary);
        $sql->bindparam(":item_categoryid",$ddlCategory);
        $sql->bindparam(":item_name",$txtTitle);
        $sql->bindparam(":item_contitionid",$ddlCondition);
        $sql->bindparam(":item_description",$txtDescription);
        $sql->bindparam(":item_deliveryoptionid",$ddlDelveryOption);
        $sql->bindparam(":item_deliverydescription",$txtDelveryDescription);
        $sql->bindparam(":item_contactname",$txtContactName);
        $sql->bindparam(":item_contactnumber1",$txtContactNumber);
        $sql->bindparam(":item_contactnumber2",$txtContactNumber2);
        $sql->bindparam(":item_contactnumber3",$txtContactNumber3);
        $sql->bindparam(":item_contactemail",$txtEmail);
        $sql->bindparam(":item_id",$itemId);
        $sql->bindparam(":item_user_id",$_SESSION["userId"]);
        $sql->execute();

        $msg="Your Updates are submitted and under review. It will be posted soon.";
        redirect(encyptMsgURL("myaccount.php",$msg));
    }

//Delete
    if(isset($_GET["del"])){
        $itemId=resolveURLmsg($_GET["del"]);
        $sql_quary="UPDATE `doacc_item` SET `item_statuscode`=5 WHERE `item_id`=:item_id AND `item_user_id`=:item_user_id;";
        $sql = $conn->prepare($sql_quary);
        $sql->bindparam(":item_id",$itemId);
        $sql->bindparam(":item_user_id",$_SESSION["userId"]);
        $sql->execute();

        $msg="Item has been deleted";
        redirect(encyptMsgURL("myaccount.php",$msg));
    }

//Donated
    if(isset($_GET["donated"])){
        $itemId=resolveURLmsg($_GET["donated"]);
        $sql_quary="UPDATE `doacc_item` SET `item_statuscode`=2 WHERE `item_id`=:item_id AND `item_user_id`=:item_user_id;";
        $sql = $conn->prepare($sql_quary);
        $sql->bindparam(":item_id",$itemId);
        $sql->bindparam(":item_user_id",$_SESSION["userId"]);
        $sql->execute();

        $msg="Item has been marked as donated.";
        redirect(encyptMsgURL("myaccount.php",$msg));
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>NearBuy - Sell</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Contact-FormModal-Contact-Form-with-Google-Map.css">
    <link rel="stylesheet" href="assets/css/Footer-Dark.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="assets/css/Multi-step-form.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Button.css">
    <link rel="stylesheet" href="assets/css/styles.css">

    <!-- Image Uploader CSS -->
    <link rel="stylesheet" type="text/css" href="imageUploader/imageuploader.css">
    <!-- Array For Image Uploader -->
    <script type="text/javascript">
        let imageArray;
    </script>
</head>

<body>
    <?php showNavBar("sell"); // navigation bar ?>
    <section class="clean-block clean-form dark h-100">
        <div class="container" style="max-width: 500px;">
            <div class="block-heading" style="padding-top: 10px;text-align: center;">
                <h2 class="text-primary">List Item For Sale<br></h2>
            </div>
            <form id="main-form" enctype="multipart/form-data" role="form" action="sell.php" method="post">
                <input type="hidden" id="hidItemId" name="hidItemId" value="<?php echo $itemId; ?>">
                <h4>What is your donation?</h4>
                <div class="form-group mb-3">
                    <label class="form-label">Category</label>
                    <?php
                        $c_sql="SELECT * FROM itemcategory;";
                        $class="form-select countries order-alpha limit-pop-1000000 presel-MX group-continents group-order-na";
                        dbCombo($c_sql,"ddlCategory","Category_ID","Category_Name",$ddlCategory,$c_required=true,$class);
                    ?>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Title</label>
                    <input class="form-control" type="text" id="txtTitle" placeholder="Title" name="txtTitle" autocomplete="on" value="<?php echo $txtTitle; ?>">
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" id="txtDescription" placeholder="Description" name="txtDescription"><?php echo $txtDescription; ?></textarea>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Price</label>
                    <input class="form-control" type="text" id="txtPrice" placeholder="Price" name="txtPrice" value="<?php echo $txtPrice; ?>">
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Images</label>
                    <div class="row">
                        <div class="col-sm-4">
                            <input accept="image/*" class="uploadbox" type="file" id="img1" name="img1"/>
                            <input type="hidden" name="hidimg1Cleard" id="hidimg1Cleard" value="">
                            <button id="btnimg1Cleard" type="button" onclick="setCleard(this.id,imageArray)" class="btn btn-warning  d-block w-100"><i class="fas fa-save"></i>&nbsp;Clear</button>
                        </div>
                        <div class="col-sm-4">
                            <input accept="image/*" class="uploadbox" type="file" id="img2" name="img2"/>
                            <input type="hidden" name="hidimg2Cleard" id="hidimg2Cleard" value="">
                            <button id="btnimg2Cleard" type="button" onclick="setCleard(this.id,imageArray)" class="btn btn-warning  d-block w-100"><i class="fas fa-save"></i>&nbsp;Clear</button>
                        </div>
                        <div class="col-sm-4">
                            <input accept="image/*" class="uploadbox" type="file" id="img3" name="img3"/>
                            <input type="hidden" name="hidimg3Cleard" id="hidimg3Cleard" value="">
                            <button id="btnimg3Cleard" type="button" onclick="setCleard(this.id,imageArray)" class="btn btn-warning  d-block w-100"><i class="fas fa-save"></i>&nbsp;Clear</button>
                        </div>
                    </div>
                <h4>Contact Information</h4>
                <div class="form-group mb-3">
                    <label class="form-label">Contact Name</label>
                    <input class="form-control" type="text" id="txtContactName" placeholder="Contact Name" name="txtContactName" autocomplete="on" value="<?php echo $txtContactName; ?>" maxlength="50">
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Contact Number</label>
                    <div class="row">
                        <div class="col-sm-4">
                            <input class="form-control" type="number" maxlength="10" id="txtContactNumber" placeholder="Contact number" required name="txtContactNumber" autocomplete="on" value="<?php echo $txtContactNumber; ?>">
                        </div>
                        <div class="col-sm-4">
                            <input class="form-control" type="number" maxlength="10" id="txtContactNumber2" placeholder="Contact number 2" name="txtContactNumber2" value="<?php echo $txtContactNumber2; ?>">
                        </div>
                        <div class="col-sm-4">
                            <input class="form-control" type="number" maxlength="10" id="txtContactNumber3" placeholder="Contact number 3" name="txtContactNumber3" value="<?php echo $txtContactNumber3; ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <button class="btn btn-primary d-block w-100" type="submit" name="<?php echo $submitBtnName; ?>"><i class="fas fa-save"></i>&nbsp;Submit</button>
                </div>
            </form>
        </div>
    </section>
    <?php
        showFooter();  //footer 
        showAlert($JSAlertMessage);
    ?>

    <!-- Image Uploader -->
    <script type="text/javascript" src="imageUploader/imageuploader.js"></script>

    <!-- Load images for Edit -->
    <script type='text/javascript'>
        <?php
        $js_array = json_encode($arrImages);
        echo "imageArray = ". $js_array . ";\n";
        ?>

        function changeImageBoxWithPath(item, index, arr) {
            let pathArray = window.location.pathname.split('/');
            var newPathname = "";
            for (i = 0; i < pathArray.length-1; i++) {
                newPathname += pathArray[i];
                newPathname += "/";
            }

            let absurl = window.location.protocol + "//" + window.location.host + newPathname;

            arr[index] = absurl + item;

            //console.log(arr[index]);
        }

        imageArray.forEach(changeImageBoxWithPath);

        //console.log(imageArray.toString());
        if(imageArray.length>0){
            document.getElementById("img1").style.backgroundImage = "url('"+ imageArray[0] +"')";
            document.getElementById("img2").style.backgroundImage = "url('"+ imageArray[1] +"')";
            document.getElementById("img3").style.backgroundImage = "url('"+ imageArray[2] +"')";
        }

        function setCleard(btnid,arr){
            if(btnid=="btnimg1Cleard"){
                document.getElementById("hidimg1Cleard").value = arr[0];
                document.getElementById("img1").style.backgroundImage = "url('imageUploader/upload.png')";
                document.getElementById("img1").value="";
            }
            else if(btnid=="btnimg2Cleard"){
                document.getElementById("hidimg2Cleard").value = arr[1];
                document.getElementById("img2").style.backgroundImage = "url('imageUploader/upload.png')";
                document.getElementById("img2").value="";
            }
            else if(btnid=="btnimg3Cleard"){
                document.getElementById("hidimg3Cleard").value = arr[2];
                document.getElementById("img3").style.backgroundImage = "url('imageUploader/upload.png')";
                document.getElementById("img3").value="";
            }
        }

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/Contact-FormModal-Contact-Form-with-Google-Map.js"></script>
</body>

</html>