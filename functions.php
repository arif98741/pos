<?php

include_once 'classes/Supplier.php';
include_once 'classes/Invoice.php';
$sup = new Supplier();
$in = new Invoice();

/* data insert for supplier */
if (isset($_POST['page']) && $_POST['page'] == 'add_supplier') {
    echo $sup->insertSeller($_POST);
}

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

if (isset($_GET['page']) && $_GET['page'] == 'invoice' && $_GET['action'] == 'show_invoice_products') {
    echo $st = $in->showProduct(); //showing invoice data
}

if (isset($_POST['page']) && isset($_POST['action']) && $_POST['action'] = 'show_product_by_invoice_id') {
    $invoice_no = $_POST['invoice_no'];
    $date = $_POST['date'];
    $supplier_id = $_POST['supplier_id'];
    $in->showProductByInvoiceId($invoice_no, $date, $supplier_id);
}
?>