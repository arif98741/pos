<?php include 'lib/header.php'; ?>
<?php
$msg = '';

//add invoice
if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['addinvoice'])) {
    if (isset($_POST['quantity'])) {
        //$msg = $inv->saveInvoice($_POST);
    }
}


//edit invoice
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit'])) {
    //$msg = $inv->updateInvoice($_POST);
}

//delete invoice
if (isset($_GET['action']) && isset($_GET['serial']) && isset($_GET['sell_id'])) {
    $serial = $_GET['serial'];
    $msg = $sel->deleteSale($serial, $_GET['sell_id']);
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
                <h3><i class="fa fa-chevron-circle-right"></i>&nbsp;View Sales List</h3>
            </div>
            <div class="page_info_right">
                <a href="addsell.php" class="btn btn-success add_new_pro_btn"><i class="fa fa-cart-plus"></i>&nbsp;Add Sell</a>
                <a href="products.php" class="btn btn-info back_btn">Back</a>
            </div>
        </div>

        <table class="table table-bordered invoice_table" id="invoice_product_data_table">
            <thead>
                <tr>
                    <th>Serial</th>
                    <th>Invoice ID</th>
                    <th>Customer</th>
                    <th>Sub Total</th>
                    <th>Grand Total</th>
                    <th>Paid</th>
                    <th>Due</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $status = $sel->showSalesList();

                if ($status) {
                    $i = 0;
                    while ($result = $status->fetch_assoc()) {
                        $i++;
                        ?>
                        <tr style="text-align: center;" id="rowid-<?php echo $result['serial']; ?>">
                            <td><?php echo $i; ?></td>
                            <td><?php echo $result['sell_id']; ?></td>
                            <td><?php echo $result['customer_name']; ?></td>
                            <td><?php echo $result['sub_total']; ?></td>
                            <td><?php echo $result['grand_total']; ?></td>
                            <td><?php echo $result['paid']; ?></td>
                            <td><?php echo $result['due']; ?></td>
                            <td>
                                <a href="viewsale.php?action=view&serial=<?php echo $result['serial'] ?>&sell_id=<?php echo $result['sell_id']; ?>" style="border-radius: 3px;" title="click to view" ><i class="fa fa-eye"></i>&nbsp;&nbsp;</a>
                                <a href="editsale.php?action=edit&serial=<?php echo $result['serial'] ?>&sell_id=<?php echo $result['sell_id']; ?>" style="border-radius: 3px;" title="click to edit" ><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;</a>
                                <a href="?action=delete&serial=<?php echo $result['serial'] ?>&sell_id=<?php echo $result['sell_id']; ?>" style="border-radius: 3px;" title="click to delete" onclick="return confirm('are you sure to delete?')" id="rowdelete" delid="<?php echo $result['serial']; ?>"><i class="fa fa-trash"></i></a>
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