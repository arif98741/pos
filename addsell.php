<?php include 'lib/header.php'; ?>
<style>
    td{
        padding: 5px;

    }
    .sell_products_table tr{
        text-align: center;
    }
</style>


<div class="container">
    <div class="content_section">
        <div class="page_info">


            <div class="page_info_left">
                <h3><i class="fa fa-chevron-circle-right"></i>&nbsp;Sell Product</h3>
            </div>
            <div class="page_info_right">
                <a href="viewsales.php" class="btn btn-success add_new_pro_btn"><i class="fa fa-eye"></i>View Sales</a>
                <a href="#" class="btn btn-info back_btn">Back</a>

            </div>
        </div>
        <div class="add_product">
            <label>INVOICE No.</label>
            <?php
            // $last_in_st = $db->select("select * from tbl_sell order by serial desc limit 1");
            $last_id = $db->select("select * from tbl_sell order by serial desc limit 1")->fetch_assoc();
            $rrr = $last_id['sell_id'];
            $rrr = substr($rrr, 6);
            $rrr = date('m') . date('Y') . ($rrr + 1);
            ?>
            <input type="text" value="<?php echo $rrr; ?>" readonly="" class="form-control sell_id" style=" max-width: 300px;">
            <br/>
            <div class="form-section">
                <div class="balance-section col-md-8">
                    <table class="table table-bordered" id="customer_details"> <!--customer table start-->
                        <tbody class="customer_dropdown">
                            <tr>
                                <th>Customer ID</th>
                                <td>
                                    <b class="customer_dropdown_body">
                                        <select class="form-control customer_data_dropdown">
                                            <option value="">Select</option>
                                            <?php
                                            $cus_st = $cus->showCustomerForDropdown();
                                            if ($cus_st) {
                                                while ($row = $cus_st->fetch_assoc()) {
                                                    ?>
                                                    <option value="<?php echo $row['customer_id']; ?>"><?php echo $row['customer_name']; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </b>
                                    <button type="button" class="btn-primary po" data-toggle="modal" data-target=".add_customer_modal" title="Click To Add Customer"><i class="fa fa-user-plus"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <th>Customer Name</th>
                                <td id="customer_name"></td>
                            </tr>
                            <tr>
                                <th>Customer Address</th>
                                <td id="customer_address"></td>

                            </tr>
                            <tr>
                                <th>Customer Contact</th>
                                <td id="customer_contact"></td>
                            </tr>
                        </tbody>
                    </table><!--customer table end-->
                    <!--count table start-->
                    <br/>
                    <form action="print.php" method="post">
                        <table class="table-bordered">
                            <tbody class="sell_product_body">
                                <tr style="text-align: right;">
                                    <td width="60%">Balance</td>
                                    <td><input class="form-control customer_balance" name="balance" required=""  style="text-align:right;"></td>
                                </tr>
                                <tr style="text-align: right;">
                                    <td width="60%">Sub-Total</td>
                                    <td><input name="sell_subtotal" name="sub_total" class="form-control sell_subtotal"   style="text-align:right;"></td>
                                </tr>
                                <tr style="text-align: right;">
                                    <td width="60%">Discount</td>
                                    <td><input name="sell_discount"  class="form-control customer_discount"  style="text-align:right;"></td>
                                </tr>
                                <tr style="text-align: right;">
                                    <td width="60%">Vat(10%)</td>
                                    <td><input class="form-control sell_vat" name="sell_vat"  required="" style="text-align:right;"></td>
                                </tr>
                                <tr style="text-align: right;">
                                    <td width="60%">DL</td>
                                    <td width="60%"><input class="form-control sell_dl" name="sell_dl" style="text-align:right;"></td>
                                </tr>
                                <tr style="text-align: right;">
                                    <td width="60%">Grand Total</td>
                                    <td><input name="sell_grand_total" required="" class="form-control sell_grandtotal" value="0" style="text-align:right;"></td>
                                </tr>
                                <tr style="text-align: right;">
                                    <td width="60%">Paid</td>
                                    <td><input name="sell_paid" class="form-control sell_paid" required="" style="text-align:right;"></td>
                                </tr>
                                <tr style="text-align: right;">
                                    <td width="60%">Due</td>
                                    <td>
                                        <input name="sell_due" class="form-control sell_due" value="0" required="" style="text-align:right;">
                                        <input value="<?php echo $rrr; ?>" type="hidden" class="hidden_sell_id"  name="sell_id">
                                        <input type="hidden" class="hidden_customer_id" name="customer_id">
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                        <br/>
                        <input type="submit" value="Sell Product" class="btn btn-primary sell_product_btn">
                    </form>
                    <p class="show_error">Remark:</p> 

                </div>

                <div class="product-section col-md-4">
                    <!--add new product-->

                    <table class="table-bordered" style="text-align:justify;">
                        <tbody id="product_add_body">
                            <tr>
                                <td>Product ID</td>
                                <td><input type="text" name="product_id" id="product_id" class="form-control product_id"></td>
                            </tr>
                            <tr>
                                <td>Group</td>
                                <td>
                                    <b class="product_group">
                                        <select name="product_group" id="" class="form-control product_group_dropdown" >
                                            <option value="1">Select</option>
                                            <?php
                                            $allgroupsstmt = $db->link->query("SELECT * FROM `tbl_group` ORDER BY `groupname` ASC");
                                            ?>
                                            <?php if ($allgroupsstmt): ?>
                                                <?php while ($r = $allgroupsstmt->fetch_assoc()): ?>
                                                    <option value="<?php echo $r['groupid']; ?>"><?php echo $r['groupname']; ?></option>
                                                <?php endwhile; ?>
                                            <?php endif; ?>
                                        </select>
                                    </b>
                                </td>
                            </tr>

                            <tr>
                                <td>Product Name</td>
                                <td>
                                    <b class="product_name">

                                    </b>
                                </td>
                            </tr>
                            <tr>
                                <td>Size/Color</td>
                                <td>
                                    <input type="text" name="product_size" id="product_size" class="form-control product_size" placeholder="Size">
                                    <input type="text" name="product_color" id="product_color" class="form-control product_color" placeholder="Color">
                                </td>
                            </tr>

                            <tr>
                                <td>Quantity/Stock</td>
                                <td>
                                    <input type="text" name="product_quantity" id="product_quantity" class="form-control product_quantity" placeholder="Quantity">
                                    <input type="text" name="product_stock" id="product_stock" class="form-control product_stock" placeholder="Stock">
                                </td>
                            </tr>

                            <tr>
                                <td>Carton/Piece</td>
                                <td>
                                    <input type="text" name="product_carton" id="product_carton" class="form-control product_carton" placeholder="Carton">
                                    <input type="text" name="product_piece" id="product_piece" class="form-control product_piece" placeholder="Piece">
                                </td>
                            </tr>
                            <tr>
                                <td>Total Price</td>
                                <td>
                                    <input type="text" name="total_price" value="0" class="form-control total_price"  style="text-align:right;">
                                </td>
                            </tr>

                            <tr>
                                <td>Unit Price</td>
                                <td><input type="text" id="unit_price"  value="0"  class="form-control unit_price"  style="text-align:right;"></td>
                            </tr>
                            <tr>
                                <td>Discount(%)</td>
                                <td><input type="text" name="discount" id="discount" class="form-control discount"  style="text-align:right;"></td>
                            </tr>
                            <tr>
                                <td>Sub-Total</td>
                                <td><input type="text" name="subtotal"   value="0"  id="subtotal" class="form-control subtotal" style="text-align:right;"></td>
                            </tr>
                        </tbody>
                    </table>
                    <br/>
                    <button type="reset" class="btn btn-primary" type="">Reset</button> 
                    <button type="reset" class="btn btn-success add_new_product" type="">Add New</button> 

                    <br/><br/>
                </div>

                <table class="table-bordered purchase_product_table" style="text-align:center;">
                    <tbody class="sell_products_table" style="text-align: center;">
                        <tr>
                            <th>Serial</th>
                            <th> Product ID</th>
                            <th>Product Group</th>
                            <th>Brand</th>
                            <th>Quantity</th>
                            <th>Piece</th>
                            <th>Unit Price</th>
                            <th>Unit Price</th>
                            <th>Subtotal</th>
                            <th>Action</th>
                        </tr>
                        <tr>
                            <td colspan="10">No Product Added in the sales list</td>
                        </tr>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>

<!--bootstrap popup modal-->
<!--customer add modal start-->
<div class="modal fade add_customer_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-open" role="document">
        <div class="modal-content">

            <div class="modal-header bg-primary">
                <h4><i class="fa fa-user-plus"></i>&nbsp;Add New Customer</h4>
            </div>
            <div class="modal-body">
                <table>
                    <tbody class="pop_form_body">
                        <tr>
                            <td>
                                <input type="text" id="pop_customer_id" class="form-control" placeholder="Customer ID">
                            </td>
                            <td>
                                <input type="text"  id="pop_customer_name" class="form-control" placeholder="Customer Name">
                            </td>
                            <td>
                                <input type="text" id="pop_customer_address" class="form-control" placeholder="Address">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text"  id="pop_customer_contact_no" class="form-control" placeholder="Contact No.">
                            </td>
                            <td>
                                <input type="text"  id="pop_customer_discount" class="form-control" placeholder="Discount">
                            </td>
                            <td>
                                <input type="text" id="pop_customer_email" class="form-control" placeholder="Email">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" id="pop_customer_opening_balance" class="form-control" placeholder="Opening Balance">
                            </td>
                            <td>
                                <input type="text" id="pop_customer_remark"  class="form-control" placeholder="Remark">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button class="btn btn-success pop_save_customer"><i class="fa fa-save">&nbsp;Save Customer</i></button>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="display:none;" class="pop_cus_error">

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>


            <div class="modal-footer">
                <i class="fa fa-times" data-dismiss="modal" style="cursor: pointer"></i>
            </div>

        </div>
    </div>
</div>
<!--customer add modal end-->

<!--update sell products by pop up start-->
<div id="edit_sell_product_body" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content modal-open">
            <div class="modal-header  bg-primary">
                <h4>Update Sell Products</h4>
            </div>
            <div class="modal-body">

                <table>
                    <tbody class="update_sell_product_table_body">
                        <tr>
                            <td><label>Product ID</label></td>
                            <td><input type="text" class="form-control" id="update_product_id" readonly=""></td>
                            <td><label>Quantity</label></td>
                            <td>
                                <input type="text" class="form-control" id="update_product_quantity">
                                <input type="hidden" class="form-control" id="update_product_customer_id">
                            </td>


                        </tr>
                        <tr>
                            <td><label>Piece</label></td>
                            <td><input type="text" class="form-control" id="update_product_piece"></td>
                            <td><label>Vat(%)</label></td>
                            <td><input type="text" class="form-control" id="update_product_vat"></td>
                        </tr>
                        <tr>
                            <td><label>Unit Price</label></td>
                            <td><input type="text" class="form-control" id="update_product_unit_price"></td>
                            <td><label>Subtotal</label></td>
                            <td><input type="text" class="form-control" id="update_product_subtotal"></td>
                        </tr>

                    </tbody>
                </table>
                <button class="btn btn-success update_sell_product_btn" type="button">Update</button><br/><br/>
                <span class="addsell_popup_update_error" style="display: none;">Error/Success Message</span>
            </div>
            <div class="modal-footer">
                <i class="fa fa-times" data-dismiss="modal" style="cursor: pointer"></i>
            </div>
        </div>
    </div>
</div>
<!--update sell products by pop up end-->

<?php include 'lib/footer.php'; ?>