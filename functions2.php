<?php

include_once 'classes/DATABASE.php';
include_once 'classes/Supplier.php';
include_once 'classes/Invoice.php';
include_once 'classes/Extra.php';
include_once 'classes/Customer.php';
include_once 'classes/Sell.php';
$sup = new Supplier();
$in = new Invoice();
$ext = new Extra();
$cus = new Customer();
$sell = new Sell();
$db = new DATABASE();

//insert customer information
if (isset($_POST['page']) && $_POST['page'] = 'adcustomer' && $_POST['action'] == 'insert_customer') {
    echo $cus->insertCustomer($_POST);
}

//store selling products in database for a specific sell_id and customer before save.
if (isset($_POST['action']) && $_POST['action'] == 'addsellproducts') {
    echo $sell->storeSellProducts($_POST);
}

//show sold products before print in addsell.php
if (isset($_POST['action']) && $_POST['action'] == 'showsellproducts') {
    if (isset($_POST['sell_id'])) {
        echo $sell->showSellProducts($_POST['sell_id'], $_POST['customer_id']);
    }
}

//remove single sell product for specific sell_id,customer
if (isset($_POST['action']) && $_POST['action'] == 'removesellproducts') {
    $result = $sell->deleteSingleProduct($_POST['product_id'], $_POST['sell_id']);
    if ($result) {
        echo "Deleted";
    } else {
        echo "Not Deleted";
    }
}

//get total value of sold products for a single sell id in addsell.php
if (isset($_POST['page']) && isset($_POST['action']) && isset($_POST['customer_id']) && isset($_POST['sell_id']) && $_POST['action'] = 'gettotal') {
    echo $sell->getTotal($_POST);
}

//insert popup customer from addsell.php
if (isset($_GET['action']) && $_GET['action'] == 'addpopupcustomer') {
    echo $cus->addPopCustomer($_GET);
}

//insert popup customer from addsell.php
if (isset($_GET['action']) && $_GET['action'] == 'getAllCustomers' && isset($_GET['behaviour'])) {
    echo $cus->getPopCustomers();
}

//get data for update sigle product in addsell.php
if (isset($_POST['action']) && $_POST['action'] == 'getSingleProductDataForUpdate') {
    $sell_id = $_POST['s_sell_id'];
    $cus_id = $_POST['s_cus_id'];
    $pro_id = $_POST['s_pro_id'];
    $query = "SELECT tbl_sell_products.sell_id,tbl_sell_products.customer_id,tbl_sell_products.quantity,tbl_sell_products.product_piece,tbl_sell_products.subtotal,tbl_product.unit_price FROM tbl_sell_products,tbl_product WHERE 
                tbl_sell_products.sell_id='$sell_id' AND 
                tbl_sell_products.customer_id='$cus_id' AND 
                tbl_sell_products.product_id='$pro_id' AND 
                tbl_sell_products.product_id = tbl_product.product_id AND
                tbl_sell_products.status='0'";
    $st = $db->link->query($query);
    if ($st) {
        echo json_encode($st->fetch_array());
    }
}
//update single product for popup in addsell.php
if (isset($_POST['action']) && $_POST['action'] == 'updateSingleProductForDatabase') {
    echo $sell->udpateSingleProPopup($_POST);
}
?>

