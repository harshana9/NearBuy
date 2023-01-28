<?php function showNavBar($currentPage){ ?>
    <nav class="navbar navbar-light navbar-expand-lg navigation-clean-button">
        <div class="container"><a class="navbar-brand" href="index.php">NearB<font color="red">u</font>y</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php if($currentPage=="sell"){echo "active";} ?>" href="sell.php">Sell Someting</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if($currentPage=="search"){echo "active";} ?>" href="search.php">Search Something</a>
                    </li>
                </ul>
                <span class="navbar-text actions">
                    <a class="login <?php if($currentPage=="account"){echo "active";} ?>" href="myaccount.php">My Account</a>
                    <a class="login <?php if($currentPage=="login"){echo "active";} ?>" href="login.php">Log In</a>
                    <a class="btn btn-light action-button" role="button" href="register.php">Sign Up</a>
                </span>
            </div>
        </div>
    </nav>
<?php } ?>