<?php include 'lib/header.php'; ?>
<?php
if (isset($_POST['quantity'])) {
    //echo $_POST['serial_no'][4];
}
//save invoice
$msg = '';

//add invoice
if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['addinvoice'])) {
    if (isset($_POST['quantity'])) {
        $msg = $inv->saveInvoice($_POST);
    }
}


//edit invoice
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit'])) {
    $msg = $inv->updateInvoice($_POST);
}

//delete invoice
if (isset($_GET['action']) && isset($_GET['serial']) && isset($_GET['invoice_id'])) {
    $serial = $_GET['serial'];
    echo $serial;
    $msg = $inv->deleteInvoice($serial, $_GET['invoice_id']);
}
?>

<div class="container">
    <div class="content_section">

        <div class="page_info">
            <?php
            if (isset($msg) && $msg != '') {
                echo $msg;
            }
            ?>
            <div class="page_info_left">
                <h3><i class="fa fa-chevron-circle-right"></i>&nbsp;View Invoice List</h3>
            </div>
            <div class="page_info_right">
                <a href="addinvoice.php" class="btn btn-success add_new_pro_btn"><i class="fa fa-plus"></i>Add Invoice</a>
                <a href="products.php" class="btn btn-info back_btn">Back</a>
            </div>
        </div>

        <table class="table table-bordered invoice_table" id="invoice_product_data_table">
            <thead>
                <tr>
                    <th>Serial</th>
                    <th>Invoice No.</th>
                    <th>Supplier</th>
                    <th>Piece</th>
                    <th>Purchase</th>
                    <th>Subtotal</th>
                    <th>Total</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $status = $inv->showInvoices();

                if ($status) {
                    $i = 0;
                    while ($result = $status->fetch_assoc()) {
                        $i++;
                        ?>
                        <tr style="text-align: center;" id="rowid-<?php echo $result['serial']; ?>">
                            <td><?php echo $i; ?></td>
                            <td><?php echo $result['invoice_number']; ?></td>
                            <td><?php echo $result['supplier_name']; ?></td>
                            <td><?php echo $result['piece']; ?></td>
                            <td><?php echo $result['purchase']; ?></td>
                            <td><?php echo $result['subtotal']; ?></td>
                            <td><?php echo $result['total']; ?></td>
                            <td><?php echo $result['date']; ?></td>
                            <td>
                                <a href="viewinvoice.php?action=view&serial=<?php echo $result['serial'] ?>&invoice_id=<?php echo $result['invoice_number']; ?>" style="border-radius: 3px;" title="click to edit" ><i class="fa fa-eye"></i>&nbsp;&nbsp;</a>
                                <a href="editinvoice.php?action=edit&serial=<?php echo $result['serial'] ?>&invoice_id=<?php echo $result['invoice_number']; ?>" style="border-radius: 3px;" title="click to edit" ><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;</a>
                                <a href="?action=delete&serial=<?php echo $result['serial'] ?>&invoice_id=<?php echo $result['invoice_number']; ?>" style="border-radius: 3px;" title="click to delete" onclick="return confirm('are you sure to delete?')" id="rowdelete" delid="<?php echo $result['serial']; ?>"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>

                        <?php
                    }
                } else {
                    ?>

                <?php }
                ?>
            </tbody>

        </table>



    </div>
    <?php include 'lib/footer.php'; ?>