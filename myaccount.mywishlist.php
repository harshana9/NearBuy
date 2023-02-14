<?php
require_once("include/dbcon.inc.php");
require_once("include/redirect.inc.php");
require_once("ui/jsAlert.ui.php");
?>
    <section class="clean-block clean-form dark h-100">
        <div class="container" style="max-width: 500px;">
            <div class="block-heading" style="padding-top: 10px;">
                <h2 class="text-primary">My Wish List<br></h2>
            </div>
            <?php
                $sql_quary="SELECT * FROM `wishlist` WHERE `User_ID`=:user_id;";
                $sql = $conn->prepare($sql_quary);
                $sql->bindparam(":user_id",$_SESSION["userId"]);
                $sql->execute();
                $numRows = $sql->fetchAll();
                if(count($numRows)>0){
                    foreach($numRows as $row){
                        $wishID=$row["Wish_ID"];
                        $name=$row["Name"];
                        $keyword1=$row["Keyword1"];
                        $keyword2=$row["Keyword2"];
                        $keyword3=$row["Keyword3"];
                        $keyword4=$row["Keyword4"];
            ?>
                        <div class="card bg-light border-primary mb-3">
                            <div class="card-header">
                                <h5 class="card-title"><?php echo $name; ?></h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h4>Keywords</h4>
                                        <ul style="list-style-type: square;">
                                            <li><?php echo $keyword1; ?></li>
                                            <li><?php echo $keyword2; ?></li>
                                            <li><?php echo $keyword3; ?></li>
                                            <li><?php echo $keyword4; ?></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent">
                                <a href="mapSearch/" class="btn btn-info">Check on map</a>
                                <!--<a href="<?php //echo encyptMsgURL("donateitem.php",$wishID,"edit") ?>" class="btn btn-warning">Edit</a>-->
                                <a href="wishcommands.php?WishDel=<?php echo $wishID?>" class="btn btn-danger float-end">Remove</a>
                            </div>
                        </div>
            <?php

                    }
                }

            ?>
        </div>
    </section>