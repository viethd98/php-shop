<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title><?= $_VIEW['title'] ?></title>
    <link rel="shortcut icon" href="<?=baseurl('public/icon.ico')?>" type="image/x-icon"/>
    <meta name="robots" content="noindex, nofollow">
    <link href="<?=baseurl('public/assets/materialize/icon.css?family=Material+Icons')?>" rel="stylesheet">
    <link rel="stylesheet" href="<?=baseurl('public/assets/materialize/materialize.min.css') ?>">
    <link rel="stylesheet" href="<?=baseurl('public/assets/w3/w3.css') ?>">
    <link rel="stylesheet" href="<?=baseurl('public/assets/style.css') ?>">
</head>
<body>
    <!-- Navigation Menu -->
    <nav class="light-blue lighten-1 text-space" role="navigation">
        <div class="nav-wrapper container"><a id="logo-container" href="<?=baseurl()?>" class="brand-logo">Ecommerce Basic</a>
            <!-- Main Menu -->
            <ul class="right hide-on-med-and-down">
                <li><a href="<?=baseurl('admin/product')?>">Admin</a></li>
                <li><a href="<?=baseurl('cart')?>"><i class="material-icons">shopping_cart</i></a></li>
            </ul>
            <!-- Mobile Menu -->
            <ul id="nav-mobile" class="sidenav">
                <li><a href="<?=baseurl('cart')?>">Cart <i class="material-icons">shopping_cart</i></a></li>
                <li><a href="<?=baseurl('admin/product')?>">Admin <i class="material-icons">people</i></a></li>
            </ul>
            <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        </div>
    </nav>
    <!-- End - Navigation Menu -->
    <div class="main-container">
        <!-- Main Coontent Start Here -->
        <?php include($_VIEW['page']) ?>
        <!-- End of Main Coontent -->
    </div>
    <!--  Scripts-->
    <script type="text/javascript" src="<?=baseurl('public/assets/jquery/jquery-3.4.1.min.js')?>"></script>
    <script type="text/javascript" src="<?=baseurl('public/assets/materialize/materialize.min.js')?>"></script>
    <script type="text/javascript" src="<?=baseurl('public/assets/main.js')?>"></script>
  </body>
</html>
