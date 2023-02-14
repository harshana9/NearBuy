<?php

//url = encyptMsgURL("viewItem.php",$urlBack,"urlBack");

function showFooter($linkModify=false){ 
    $linkPrefix=null;
    if($linkModify){
        $linkPrefix="./../";
    }
?>
    <footer class="footer-dark">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-3 item">
                    <h3>Goto</h3>
                    <ul>
                        <li><a href="<?php echo $linkPrefix; ?>index.php">Home</a></li>
                        <li><a href="<?php echo $linkPrefix; ?>register.php">Sign up</a></li>
                        <li><a href="<?php echo $linkPrefix; ?>mapSearch">Search on map</a></li>
                        <li><a href="<?php echo $linkPrefix; ?>search.php">Search on market</a></li>
                        <li><a href="<?php echo $linkPrefix; ?>about.php">About</a></li>
                    </ul>
                </div>
                <div class="col-sm-6 col-md-3 item">
                    <h3>Contacts</h3>
                    <ul>
                        <!--<li><a href="#">Tel : </a></li>-->
                        <li><a href="mailto:admin@doacc.rf.gd">Email : admin@nearbuy.rf.gd</a></li>
                        <li><a href="<?php echo $linkPrefix; ?>index.php">Web : www.nearbuy.rf.gd</a></li>
                    </ul>
                </div>
                <div class="col-sm-6 col-md-3 item">
                    <h3>Mobile App</h3>
                    <ul>
                        <li><a href="https://drive.google.com/uc?export=download&id=1pzaXYBhhcZvH3AhhfA_r5rCN-vmwdHhS"><img src="<?php echo $linkPrefix; ?>images/android.png" style="width:15pt;"/> Download Android App</a><br/>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-6 col-md-3 item">
                    <h3>&nbsp;</h3>
                    <img src="<?php echo $linkPrefix; ?>images/appQR.png" style="width:95pt;">
                </div>
                <!--<div class="col item social"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-instagram"></i></a></div>-->
            </div>
            <p class="copyright">NearBuy © 2022</p>
        </div>
    </footer>
<?php } ?>