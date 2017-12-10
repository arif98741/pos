<?php include 'lib/header.php'; ?>
<?php
$msg = '';
$sell_id = '';
if (isset($_POST['sell_id'])) {

    $msg = $sel->saveSaleInvoice($_POST);
    $sell_id = $_POST['sell_id'];
}
?>

<div class="container">
    <div class="content_section">
        <?php
        if (isset($msg) && $msg != '') {
            echo $msg;
        }
        ?>
        <div class="page_info">
            <div class="page_info_left">
                <h3><i class="fa fa-chevron-circle-right"></i>&nbsp;Sold Products Preview</h3>
            </div>
            <div class="page_info_right">
                <a href="addsell.php" class="btn btn-info back_btn">Back</a>
            </div>
        </div>

        <div class="col-md-6">
            <h4>Invoice ID:  <?php if (isset($_POST['sell_id'])): ?> <?php echo $_POST['sell_id']; ?><?php endif; ?></h4>
            <h4>Date: <?php echo $help->formatDate(date("Y/m/d h:i"), 'd-m-Y g:iA'); ?></h4>
            <h4>
                <?php
                $cusstmt = $cus->singleCustomer($_POST['customer_id']);
                if ($cusstmt) {
                    $customerData = $cusstmt->fetch_assoc();
                    echo "Customer Name : " . $customerData['customer_name'];
                }
                ?>


            </h4>
            <h4>Seller: <?php echo Session::get('name'); ?></h4>
        </div>
        <div class="col-md-6">
            <a href="printsoldproduct.php?action=print&sell_id=<?php if (isset($_POST['sell_id'])): ?><?php echo $sell_id; ?><?php endif; ?>" target="_blank" style="text-align: right;"><i class="fa fa-2x fa-print"></i>&nbsp;Print</a>
        </div>
        <table class="table-bordered table" cellspacing="4" id="" width="100%">
            <thead>
                <tr>
                    <th>Serial</th>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Product Piece</th>
                    <th>Unit Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>

            <tbody style="text-align: center;">
                <?php
                $stmt = $sel->showSoldProduct($sell_id);
                $i = 0;
                if ($stmt):
                    ?>
                    <?php while ($r = $stmt->fetch_assoc()): $i++; ?>

                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $r['product_id']; ?></td>
                            <td><?php echo $r['product_name']; ?></td>
                            <td><?php echo $r['quantity']; ?></td>
                            <td><?php echo $r['product_piece']; ?></td>
                            <td><?php echo $r['unit_price']; ?></td>
                            <td><?php echo $r['subtotal']; ?></td>
                        </tr>
                    <?php endwhile; ?>


                <?php endif;
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Serial</th>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Product Piece</th>
                    <th>Unit Price</th>
                    <th>Subtotal</th>
                </tr>
            </tfoot>

        </table>
    </div>



    <?php include 'lib/footer.php'; ?>