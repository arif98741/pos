<?php include 'lib/header.php'; ?>
<style>
    td{
        padding: 15px;
    }
</style>

<?php
if (isset($_GET['action']) && isset($_GET['invoice_id']) && isset($_GET['serial'])) {
    $inv_data = $inv->getInvoiceProducts($_GET['invoice_id']); //return as array
} else {
    
}
?>

<div class="container">
    <div class="content_section">

        <div class="page_info">

            <div class="page_info_left">
                <h3><i class="fa fa-chevron-circle-right"></i>&nbsp;Invoice: <?php echo $_GET['invoice_id']; ?></h3>
            </div>
            <div class="page_info_right">
                <a href="invoices.php" class="btn btn-success add_new_pro_btn"><i class="fa fa-eye"></i>View Invoices</a>
                <a href="products.php" class="btn btn-info back_btn">Back</a>

            </div>
        </div>



        <div class="add_product">
            <br/>

            <h4>Invoice ID: 1123234</h4>
            <h4>Supplier: Akij Group</h4>
            <h4>Last Update: 12-02-2034</h4>
            <h4>Status: Delivered</h4>


            <table id="invoice_form_table" class="mdl-data-table table table-bordered">
                <thead>

                    <tr>
                        <th>Serial</th>
                        <th>Pro. ID</th>
                        <th>Group</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Size H</th>
                        <th>Size W</th>
                        <th>Quantity</th>
                        <th>Carton</th>
                        <th>Piece</th>
                        <th>Purchase</th>
                        <th>Subtotal</th>

                    </tr>
                </thead>
                <tbody id="inv_detail">

                    <?php if ($inv_data): ?>
                        <?php
                        $total = 0;
                        $serial = 0;
                        ?>
                        <?php
//                        echo "<pre>";
//                        print_r($inv_data->fetch_assoc());
//                        echo "</pre>";
                        ?>
                        <?php while ($r = $inv_data->fetch_assoc()): ?>
                            <tr style="text-align:center;">
                                <?php
                                $total += $r['subtotal'];
                                $serial++;
                                ?>
                                <td><?php echo $serial; ?></td>
                                <td><?php echo $r['product_id']; ?></td>
                                <td>
                                    <?php
                                    $groupstmt = $pro->showSingleGroup($r['product_group']);
                                    echo $groupstmt['groupname'];
                                    ?>
                                </td>
                                <td><?php echo $r['product_name']; ?></td>
                                <td>
                                    <?php
                                    $tstmt = $pro->showSingleType($r['product_type']);
                                    echo $tstmt['typename'];
                                    ?>

                                </td>
                                <td><?php echo $r['size_h']; ?></td>
                                <td><?php echo $r['size_w']; ?></td>
                                <td><?php echo $r['quantity']; ?></td>
                                <td><?php echo $r['carton']; ?></td>
                                <td><?php echo $r['piece']; ?></td>
                                <td><?php echo $r['purchase']; ?></td>
                                <td><?php echo $r['subtotal']; ?></td>

                            </tr>

                        <?php endwhile; ?>
                    <?php endif; ?>

                </tbody>

                <tfoot id="">
                    <tr style="text-align:center;">
                        <td colspan="11" style="text-align:right;"><b>Invoice Total</b></td>
                        <td colspan="1"><?php echo "<strong>" . $total . "</strong>"; ?></td>
                    </tr>

                </tfoot>
            </table>
        </div>
    </div>
    <?php include 'lib/footer.php'; ?>