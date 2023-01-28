<?php

//url = encyptMsgURL("viewItem.php",$urlBack,"urlBack");

function showFooter(){ ?>
    <footer class="footer-dark">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-3 item">
                    <h3>Goto</h3>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="signup.php">Sign up</a></li>
                        <li><a href="about.php">About</a></li>
                    </ul>
                </div>
                <div class="col-sm-6 col-md-3 item">
                    <h3>Contacts</h3>
                    <ul>
                        <!--<li><a href="#">Tel : </a></li>-->
                        <li><a href="mailto:admin@doacc.rf.gd">Email: admin@nearbuy.rf.gd</a></li>
                        <li><a href="index.php">www.nearbuy.rf.gd</a></li>
                    </ul>
                </div>
                <div class="col-md-6 item text">
                    <h3>Nearbuy</h3>
                    <p>Buy it on your way.</p>
                </div>
                <!--<div class="col item social"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-instagram"></i></a></div>-->
            </div>
            <p class="copyright">DoAcc © 2022</p>
        </div>
    </footer>
<?php } ?>