<?php include 'lib/header.php'; ?>
<style>
    td{
        padding: 15px;
    }
</style>

<?php
//save invoice
//add new row option is disabled in this page by changing class
$msg = '';

//get invoice data from server to assign in editing form 

if (isset($_GET['sell_id']) && isset($_GET['serial']) && $_GET['action'] == 'edit') {
    $sell_data = $sel->singleSale($_GET['sell_id']); //return as array
    $customer_st = $cus->singleCustomer($sell_data['customer_id']); //statement
    if ($customer_st) {
        $customer_data = $customer_st->fetch_assoc(); //array result
    }
} else {
    
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
                <h3><i class="fa fa-chevron-circle-right"></i>&nbsp;Update Sale</h3>
            </div>
            <div class="page_info_right">
                <a href="viewsales.php" class="btn btn-success add_new_pro_btn"><i class="fa fa-eye"></i>View Sales</a>
                <a href="#" class="btn btn-info back_btn">Back</a>

            </div>
        </div>



        <div class="add_product">
            <br/>

            <form action="viewsales.php.php" method="post">
                <button id=""  type="reset"  class="btn btn-danger" type="reset" data_id="1"><i class="fa fa-eraser"></i>&nbsp;Reset</button>
                <button type="submit" name="edit" class="btn btn-success add_invoice_btn" value=""><i class="fa fa-save"></i>&nbsp;Update Sale</button>

                <table>

                    <tr>
                        <td class=""  style="text-align: right;">
                            Invoice Number
                        </td>
                        <td>
                            <input id="invoice_number" readonly="" value="<?php echo $sell_data['sell_id']; ?>" name="invoice_number"  type="text" class="form-control" required="">
                        </td>
                        <td style="text-align: right;">
                            Customer ID
                        </td>
                        <td>
                            <select name="customer_id"  id="customer" class="form-control customer_dropdown" required="">
                                <option customer_id=''>Select</option>
                                <?php
                                $stmt = $cus->showCustomerForDropdown();
                                while ($result = $stmt->fetch_assoc()) {
                                    ?>
                                    <option <?php if ($sell_data['customer_id'] == $result['customer_id']): ?> selected="" <?php endif; ?> value="<?php echo $result['customer_id']; ?>">
                                        <?php echo $result['customer_name']; ?>
                                    </option>

                                <?php } ?>
                            </select>

                        </td>
                    </tr>
                    <tr>
                        <td class=""  style="text-align: right;">
                            Date
                        </td>
                        <td>
                            <input type="text" name="date"  value="<?php echo $help->formatDate($sell_data['date']); ?>"  class="form-control" id="date_input" required="">
                        </td>
                        <td style="text-align: right;">
                            Customer Name
                        </td>
                        <td id="supplier_name">
                            <input id="supplier_name_data" value="<?php echo $customer_data['customer_name']; ?>" type="text" class="form-control" >
                        </td>

                    </tr>


                    <tr>
                        <td class=""  style="text-align: right;">
                            Time
                        </td>
                        <td>
                            <input type="text" class="form-control" value="<?php echo $help->formatDate($sell_data['date'], 'g:i A'); ?>" id="time_input">
                        </td>
                        <td style="text-align: right;">
                            Address
                        </td>
                        <td id="supplier_address">
                            <input id="supplier_address_data"  value="<?php echo $customer_data['address']; ?>"  name="address" type="text" class="form-control" >
                        </td>

                    </tr>

                    <tr>
                        <td>

                        </td>
                        <td>

                        </td>
                        <td style="text-align: right;">
                            Contact
                        </td>
                        <td id="supplier_contact">
                            <input type="text" value="<?php echo $customer_data['contact_no']; ?>"  class="form-control" id="suppplier_contact_data">
                        </td>

                    </tr>

                </table>



                <table id="invoice_form_table" class="mdl-data-table table table-bordered">
                    <thead>

                        <tr>
                            <td>Serial</td>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Piece</th>
                            <th>Unit Price</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody id="inv_detail">
                        <?php
                        //get invoice products for a single invoice id
                        $allinProQuery = $sel->getSellProducts($sell_data['sell_id']);
                        ?>
                        <?php if ($allinProQuery): ?>
                            <?php
                            $invoice_total = 0;
                            $i = 0;
                            ?>
                            <?php while ($getData = $allinProQuery->fetch_assoc()): $i++; ?>
                                <?php $invoice_total += $getData['subtotal']; ?>
                            <input name="serial_no[]" type="hidden" class="form-control" value="<?php echo $getData['serial_no']; ?>" >

                            <tr style="text-align:center;">
                                <td width="10%">
                                    <?php echo $i; ?>
                                </td>
                                <td width="10%">
                                    <?php echo $getData['product_id']; ?>
                                </td>
                                <td width="10%"><b class="product_name"><?php echo $getData['product_name']; ?></b></td>


                                <td width="10%"><?php echo $getData['quantity']; ?></td>
                                <td width="8%">
                                    <b class="size_h"><?php echo $getData['product_piece']; ?></b>
                                </td>
                                <td width="8%">
                                    <b class="size_w"><?php echo $getData['unit_price']; ?></b>
                                </td>


                                <td width="8%">
                                    <input type="hidden" name="subtotalforsave[]" class="form-control subtotalforsave" value="<?php echo $getData['subtotal']; ?>" ><b class="subtotal"><?php echo $getData['subtotal']; ?></b> 
                                    <input type="hidden" name="update">
                                </td>
                            </tr>

                        <?php endwhile; ?>
                    <?php endif; ?>
                    </tbody>

                    <tfoot id="">
                        <tr>
                            <td colspan="6" style="text-align:right;"><b>Invoice Total</b></td>
                            <td colspan="1"><b class="wholetotal"><?php echo $invoice_total; ?></b></td>
                        </tr>

                    </tfoot>
                </table>
            </form>
            <button id="" style="background: #b9a5a5; color: #fff; font-size: 16px; border-radius: 3px;" title="click to add new row" class="btn btn-sm add_new_invoice_table_rowwwwww" value="Add Invoice" data_id="2">+</button>
        </div>
    </div>
    <?php include 'lib/footer.php'; ?>