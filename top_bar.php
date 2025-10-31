
<header id="header">
    <h1 id="site-logo">
        <a href="">
            <img src="admin_template/Theme/img/logos/logo.png" alt="Site Logo" />
        </a>
    </h1>   

    <a href="javascript:;" data-toggle="collapse" data-target=".top-bar-collapse" id="top-bar-toggle" class="navbar-toggle collapsed">
        <i class="fa fa-cog"></i>
    </a>

    <a href="javascript:;" data-toggle="collapse" data-target=".sidebar-collapse" id="sidebar-toggle" class="navbar-toggle collapsed">
        <i class="fa fa-reorder"></i>
    </a>
</header> <!-- header -->

<nav id="top-bar" class="collapse top-bar-collapse">
    <ul class="nav navbar-nav pull-left">
        <li>
            <a href="cart.php">
                <i class="fa fa-shopping-cart"></i>
                Cart
            </a>
        </li>
    </ul>
    <ul class="nav navbar-nav pull-right">
        <?php if (!isset($_SESSION['user_logged_in'])) { ?>
        <li>
            <a href="sign_in.php">
                <i class="fa fa-user"></i>
                Sign In
            </a>
        </li>
        <li>
            <a href="login.php">
                <i class="fa fa-sign-in"></i>
                Login
            </a>
        </li>
        <?php } else { ?>
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;">
                <i class="fa fa-user"></i>
                <?php echo ($_SESSION['username']); ?>
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
                <li class="divider"></li>
                <li>
                    <a href="logout.php">
                        <i class="fa fa-sign-out"></i>
                        Logout
                    </a>
                </li>
            </ul>
        </li>
        <?php } ?>
    </ul>
</nav> <!-- /#top-bar -->