<?php

include_once 'classes/Supplier.php';
include_once 'classes/Invoice.php';
include_once 'classes/Extra.php';
include_once 'classes/Customer.php';
$sup = new Supplier();
$in = new Invoice();
$ext = new Extra();
$cus = new Customer();

/* data insert for supplier */
if (isset($_POST['page']) && $_POST['page'] == 'add_supplier') {
    echo $sup->insertSupplier($_POST);
}

//get data for dropdown in addinvoice.php
if (isset($_POST['page']) && $_POST['page'] == 'supplier' && $_POST['supplier_id']) {
    $stmt = $sup->showSingleSupplier($_POST['supplier_id']);
    $data = $stmt->fetch_assoc();
    if ($data) {
        $arr = array(
            $data['supplier_name'],
            $data['address'],
            $data['contact_no'],
            $data['supplier_id']
        );
        echo json_encode($arr);
    } else {
        $arr = array(
            "No Supplier Found"
        );
        echo json_encode($arr);
    }
}


//get invoiceProducts in addinvoice.php during page load
if (isset($_GET['page']) && $_GET['action'] == 'showInvoiceList') {
    echo $in->showInvoices();
}


//showing productById
if (isset($_GET['page']) && $_GET['page'] = 'page' && $_GET['action'] == 'showproductbyid') {
    $stmt = $in->showProductByID($_GET['product_id']);
    echo json_encode($stmt);
}

//showing groups in addinvoice form 
if (isset($_GET['page']) && $_GET['page'] = 'addinvoice' && $_GET['action'] == 'getgroups') {
    echo $ext->showGroup();
}

//showing product name list in addinvoice form by select group
if (isset($_POST['page']) && $_POST['page'] = 'addinvoice' && $_POST['action'] == 'productnamelist' && isset($_POST['group_id'])) {
    echo $ext->showProductNameList($_POST['group_id']);
}

//showing single product details in addinvoice form by selecting product list dropdown
if (isset($_POST['page']) && $_POST['page'] = 'addinvoice' && $_POST['action'] == 'getprodetails' && isset($_POST['pro_id'])) {
    echo json_encode($ext->showSingleProDetails($_POST['pro_id']));
}

//showing single customer detail in the addsell.php for customer list dropdown
if (isset($_POST['page']) && $_POST['page'] = 'addsell' && isset($_POST['customer_id'])) {
    echo $cus->singleCustomerDetail($_POST['customer_id']);
}
?>

