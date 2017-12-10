<?php
$path = realpath(dirname(__DIR__));
include_once $path . '/classes/Session.php';
Session::checkSession();

function __autoload($class) {
    $filepath = realpath(dirname(__DIR__));
    include_once $filepath . '/classes/' . $class . '.php';
}

include_once $path . '/helper/Helper.php';
date_default_timezone_set('Asia/Dhaka');
error_reporting(E_ALL);

$db = new DB();
$log = new Login();
$pro = new Product();
$sel = new Sell();
$sup = new Supplier();
$cus = new Customer();
$inv = new Invoice();
$ext = new Extra();
$help = new Helper();


if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_destroy();
    echo "<script>window.location = 'login.php';</script>";
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <!--bootstrap css-->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/css/bootstrap.min.css.map" rel="stylesheet">
        <!--font awesome css-->
        <link href="assets/css/font-awesome.min.css" rel="stylesheet">
        <!--jquery ui css-->
        <link rel="stylesheet" href="assets/css/jquery-ui.min.css" />

        <!--developer css-->
        <link href="assets/css/style.css" rel="stylesheet">
        <!--material css-->
        <link href="assets/css/material.min.css" rel="stylesheet">

        <!--datatables-->
        <!--        <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">-->
        <title>Point Of Sale Management Servcie</title>
    </head>
    <body>




        <header>
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="index.php">Sale Management System</a>

                    </div>
                    <div id="navbar" class="navbar-collapse collapse">

                        <ul class="nav navbar-nav navbar-right">
                            <li ><a href="./">Default <span class="sr-only">(current)</span></a></li>
                            <li><a href="#">Static top</a></li>
                            <li><a href="#">Fixed top</a></li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Product<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="addproduct.php">Add Product</a></li>
                                    <li><a href="products.php">Product List</a></li>
                                    <li><a href="#">Something else here</a></li>

                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Customer<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="addcustomer.php">Add Customer</a></li>
                                    <li><a href="customerlist.php">Customer List</a></li>
                                    <li><a href="#">Others Will Be Added</a></li>

                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Sales<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="addsell.php">Sale Product</a></li>
                                    <li><a href="viewsales.php">Sales List</a></li>
                                    <li><a href="#">Others</a></li>

                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Purchase<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="addinvoice.php">Add Invoice</a></li>
                                    <li><a href="invoices.php">Invoice List</a></li>

                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Supplier<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="addsupplier.php">Add Supplier</a></li>
                                    <li><a href="supplierlist.php">Supplier List</a></li>

                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i>&nbsp;<?php echo Session::get('name'); ?> (<?php echo Session::get('status') ?>)<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="?action=logout"><i class="fa fa-sign-out"></i>Logout</a></li>
                                </ul>
                            </li>

                        </ul>
                    </div><!--/.nav-collapse -->
                </div><!--/.container-fluid -->
            </nav>
        </header>
        <?php $ext->showGroup(); ?>