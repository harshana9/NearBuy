<?php
require_once("include/dbcon.inc.php");
require_once("include/redirect.inc.php");
require_once("ui/jsAlert.ui.php");
?>
    <section class="clean-block clean-form dark h-100">
        <div class="container" style="max-width: 500px;">
            <div class="block-heading" style="padding-top: 10px;">
                <h2 class="text-primary">My Activity<br></h2>
                <p>Items You have posted are here.</p>
            </div>
            <?php
                $sql_quary="SELECT * FROM item LEFT JOIN (SELECT * FROM item_image GROUP BY item_image_item_id) AS tbl_one_image ON item.`Item_ID` = tbl_one_image.`item_image_item_id` WHERE item.`User_ID`=:item_user_id;";
                $sql = $conn->prepare($sql_quary);
                $sql->bindparam(":item_user_id",$_SESSION["userId"]);
                $sql->execute();
                $numRows = $sql->fetchAll();
                if(count($numRows)>0){
                    foreach($numRows as $row){
                        $itemId=$row["Item_ID"];
                        $title=$row["Item_Title"];
                        //$category=$row["item_categoryid"];
                        //$ddlCondition=$row["item_contitionid"];
                        $description=$row["Description"];
                        //$ddlDelveryOption=$row["item_deliveryoptionid"];
                        //$txtDelveryDescription=$row["item_deliverydescription"];
                        //$txtContactName=$row["item_contactname"];
                        //$txtContactNumber=$row["item_contactnumber1"];
                        //$txtContactNumber2=$row["item_contactnumber2"];
                        //$txtContactNumber3=$row["item_contactnumber3"];
                        //$txtEmail=$row["item_contactemail"];
                        $imgPreview=$row["item_image"];
                        //$status=$row["item_status_description"];

            ?>
                        <div class="card bg-light border-primary mb-3">
                            <div class="card-header">
                                <h5 class="card-title"><?php echo $title; ?></h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <img src="<?php echo $imgPreview; ?>" width="100%"/>
                                    </div>
                                    <div class="col-sm-8">
                                        <p class="card-text"><?php echo $description; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent">
                                <a href="<?php echo encyptMsgURL(encyptMsgURL("viewItem.php",$itemId,"item"),"myaccount.php","urlBack",true); ?>" class="btn btn-warning">View</a>
                                <a href="<?php echo encyptMsgURL("donateitem.php",$itemId,"edit") ?>" class="btn btn-warning">Edit</a>
                                <a href="<?php echo encyptMsgURL("donateitem.php",$itemId,"del") ?>" class="btn btn-danger float-end">Sold</a>
                            </div>
                        </div>
            <?php

                    }
                }

            ?>
        </div>
    </section>