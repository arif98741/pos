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

if (isset($_GET['action']) && isset($_GET['invoice_id']) && $_GET['action'] == 'edit') {
    $inv_data = $inv->singleInvoice($_GET['invoice_id']); //return as array
    $supplier_st = $sup->showSingleSupplier($inv_data['supplier_id']); //statement
    if ($supplier_st) {
        $supplier_data = $supplier_st->fetch_assoc(); //array result
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
                <h3><i class="fa fa-chevron-circle-right"></i>&nbsp;Update Invoice</h3>
            </div>
            <div class="page_info_right">
                <a href="invoices.php" class="btn btn-success add_new_pro_btn"><i class="fa fa-eye"></i>View Invoices</a>
                <a href="products.php" class="btn btn-info back_btn">Back</a>

            </div>
        </div>



        <div class="add_product">
            <br/>

            <form action="invoices.php" method="post">
                <button id=""  type="reset"  class="btn btn-danger" type="reset" data_id="1"><i class="fa fa-eraser"></i>&nbsp;Reset</button>
                <button type="submit" name="edit" class="btn btn-success add_invoice_btn" value=""><i class="fa fa-save"></i>&nbsp;Update Invoice</button>

                <table>

                    <tr>
                        <td class=""  style="text-align: right;">
                            Invoice Number
                        </td>
                        <td>
                            <input id="invoice_number" readonly="" value="<?php echo $inv_data['invoice_number']; ?>" name="invoice_number"  type="text" class="form-control" required="">
                        </td>
                        <td style="text-align: right;">
                            Supplier ID
                        </td>
                        <td>
                            <select name="supplier_id" " id="supplier" class="form-control supplier_dropdown" required="">
                                <option supplier_id=''>Select</option>
                                <?php
                                $stmt = $sup->showSupplierForDropdown();
                                while ($result = $stmt->fetch_assoc()) {
                                    ?>
                                    <option <?php if ($result['supplier_id'] == $inv_data['supplier_id']): ?> selected="" <?php endif; ?> value="<?php echo $result['supplier_id']; ?>">
                                        <?php echo $result['supplier_name']; ?>
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
                            <input type="text" name="date"  value="<?php echo $inv_data['date']; ?>"  class="form-control" id="date_input" required="">
                        </td>
                        <td style="text-align: right;">
                            Supplier Name
                        </td>
                        <td id="supplier_name">
                            <input id="supplier_name_data" value="<?php echo $supplier_data['supplier_name']; ?>" type="text" class="form-control" >
                        </td>

                    </tr>


                    <tr>
                        <td class=""  style="text-align: right;">
                            Time
                        </td>
                        <td>
                            <input type="text" class="form-control" id="time_input">
                        </td>
                        <td style="text-align: right;">
                            Address
                        </td>
                        <td id="supplier_address">
                            <input id="supplier_address_data"  value="<?php echo $supplier_data['address']; ?>"  name="address" type="text" class="form-control" >
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
                            <input type="text" value="<?php echo $supplier_data['contact_no']; ?>"  class="form-control" id="suppplier_contact_data">
                        </td>

                    </tr>

                </table>



                <table id="invoice_form_table" class="mdl-data-table table table-bordered">
                    <thead>

                        <tr>
                            <th>ID</th>
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
                        <?php
                        //get invoice products for a single invoice id
                        $allinProQuery = $inv->getInvoiceProducts($inv_data['invoice_number']);
                        ?>
                        <?php if ($allinProQuery): ?>
                            <?php $invoice_total = 0; ?>
                            <?php while ($getData = $allinProQuery->fetch_assoc()): ?>
                                <?php $invoice_total += $getData['subtotal']; ?>
                            <input name="serial_no[]" type="hidden" class="form-control" value="<?php echo $getData['serial_no']; ?>" >

                            <tr style="text-align:center;">

                                <td width="10%">
                                    <input name="product_id[]" type="text" class="form-control product_id" value="<?php echo $getData['product_id']; ?>" required >
                                </td>
                                <td width="10%">
                                    <select class="form-control product_group">
                                        <?php $groupstmt = $pro->showGroup(); ?>
                                        <?php if ($stmt->num_rows > 0): ?> 
                                            <?php while ($allgroups = $groupstmt->fetch_assoc()): ?> 
                                                <option value="<?php echo $allgroups['groupid']; ?>"  <?php if ($allgroups['groupid'] == $getData['product_group']): ?> selected="" <?php endif; ?> ><?php echo $allgroups['groupname']; ?></option>
                                            <?php endwhile; ?>
                                        <?php endif; ?>

                                    </select>
                                </td>
                                <td width="10%"><b class="product_name"><?php echo $getData['product_name']; ?></b></td>
                                <td width="10%">
                                    <b class="product_type">
                                        <?php
                                        $typeid = $getData['product_type'];
                                        $typeq = "select * from tbl_type where typeid='$typeid'";
                                        if ($typestmt = $db->link->query($typeq)) {
                                            $typedata = $typestmt->fetch_assoc();
                                            echo $typedata['typename'];
                                        }
                                        ?>

                                    </b>
                                </td>
                                <td width="8%">
                                    <b class="size_h"><?php echo $getData['size_h']; ?></b>
                                </td>
                                <td width="8%">
                                    <b class="size_w"><?php echo $getData['size_w']; ?></b>
                                </td>
                                <td width="8%">
                                    <input type="text" name="quantity[]" class="form-control quantity" value="<?php echo $getData['quantity']; ?>"  required >
                                </td>
                                <td width="8%">
                                    <input type="text" name="carton[]"  class="form-control carton" value="<?php echo $getData['carton']; ?>"  required >
                                </td>
                                <td width="8%">
                                    <input type="text" name="piece[]"  class="form-control piece" value="<?php echo $getData['piece']; ?>" required="">
                                </td>
                                <td width="8%">
                                    <input type="text" name="purchase[]" class="form-control purchase" value="<?php echo $getData['purchase']; ?>"  required >
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
                            <td colspan="10" style="text-align:right;"><b>Invoice Total</b></td>
                            <td colspan="1"><b class="wholetotal"><?php echo $invoice_total; ?></b></td>
                        </tr>

                    </tfoot>
                </table>
            </form>
            <button id="" style="background: #b9a5a5; color: #fff; font-size: 16px; border-radius: 3px;" title="click to add new row" class="btn btn-sm add_new_invoice_table_rowwwwww" value="Add Invoice" data_id="2">+</button>
        </div>
    </div>
    <?php include 'lib/footer.php'; ?>