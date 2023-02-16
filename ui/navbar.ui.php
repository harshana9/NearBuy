<?php function showNavBar($currentPage,$linkModify=false){ 
    $linkPrefix=null;
    if($linkModify){
        $linkPrefix="./../";
    }

?>

    <nav class="navbar navbar-light navbar-expand-lg navigation-clean-button">
        <div class="container"><a class="navbar-brand" href="<?php echo $linkPrefix; ?>./index.php"><font color="red">Alert</font>MyWishlist</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php if($currentPage=="sell"){echo "active";} ?>" href="<?php echo $linkPrefix; ?>sell.php">Sell</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if($currentPage=="search"){echo "active";} ?>" href="<?php echo $linkPrefix; ?>search.php">Market</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if($currentPage=="mapSearch"){echo "active";} ?>" href="<?php echo $linkPrefix; ?>./mapSearch/">Map Search</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if($currentPage=="nearbySearch"){echo "active";} ?>" href="<?php echo $linkPrefix; ?>./nearbySearch">Nearby Search</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if($currentPage=="about"){echo "active";} ?>" href="<?php echo $linkPrefix; ?>about.php">About Us</a>
                    </li>
                </ul>
                <span class="navbar-text actions">
                    <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php if($currentPage=="myaccount"){echo "active";} ?>" href="<?php echo $linkPrefix; ?>myaccount.php">My Account</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if($currentPage=="login"){echo "active";} ?>" href="<?php echo $linkPrefix; ?>login.php">Log In</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if($currentPage=="register"){echo "active";} ?>" role="button" href="<?php echo $linkPrefix; ?>register.php">Sign Up</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://drive.google.com/uc?export=download&id=1pzaXYBhhcZvH3AhhfA_r5rCN-vmwdHhS" target="_blank"><img src="<?php echo $linkPrefix; ?>images/android.png" style="width:15pt;"/> Get App</a>
                    </li>
                    <ul>
                </span>
            </div>
        </div>
    </nav>
<?php } ?>