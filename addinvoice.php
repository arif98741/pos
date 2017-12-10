<?php include 'lib/header.php'; ?>
<style>
    td{
        padding: 15px;
    }
</style>

<?php
//save invoice
$msg = '';
/* if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  if (isset($_POST['quantity'])) {
  $msg = $inv->saveInvoice($_POST);
  }
  } */
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
                <h3><i class="fa fa-chevron-circle-right"></i>&nbsp;Add New Invoice</h3>
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
                <button type="submit" class="btn btn-success add_invoice_btn" value=""><i class="fa fa-save"></i>&nbsp;Save Invoice</button>

                <table>
                    <tr>

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
                                    <option value="<?php echo $result['supplier_id']; ?>">
                                        <?php echo $result['supplier_name']; ?>
                                    </option>

                                <?php }
                                ?>
                            </select>

                        </td>
                        <td style="text-align: right;">
                            Supplier Name
                        </td>
                        <td id="supplier_name">
                            <input id="supplier_name_data" type="text" class="form-control" >
                        </td>
                    </tr>
                    <tr>
                        <td class=""  style="text-align: right;">
                            Date
                        </td>
                        <td>
                            <input type="text" name="date" class="form-control" id="date_input" required="">
                        </td>

                        <td style="text-align: right;">
                            Address
                        </td>
                        <td id="supplier_address">
                            <input id="supplier_address_data" name="address" type="text" class="form-control" >
                        </td>
                    </tr>


                    <tr>
                        <td class=""  style="text-align: right;">
                            Invoice No
                        </td>
                        <td>
                            <input type="text" name="invoice_no" class="form-control" id="time_input" required="">
                        </td>

                        <td style="text-align: right;">
                            Contact
                        </td>
                        <td id="supplier_contact">
                            <input type="text" class="form-control" id="suppplier_contact_data">
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

                    </tbody>

                    <tfoot id="">
                        <tr>
                            <td colspan="10" style="text-align:right;"><b>Invoice Total</b></td>
                            <td colspan="1"><input type="hidden" name="addinvoice"><b class="wholetotal"></b></td>
                        </tr>

                    </tfoot>
                </table>
            </form>
            <button id="" style="background: #b9a5a5; color: #fff; font-size: 16px; border-radius: 3px;" title="click to add new row" class="btn btn-sm add_new_invoice_table_row" value="Add Invoice" data_id="2">+</button>
        </div>




    </div>
    <?php include 'lib/footer.php'; ?>