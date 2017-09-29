<?php include 'lib/header.php'; ?>
<style>
    td{
        padding: 15px;
    }


</style>



<div class="container">
    <div class="content_section">

        <div class="page_info">
            <div class="page_info_left">
                <h3><i class="fa fa-chevron-circle-right"></i>&nbsp;Add New Invoice</h3>
            </div>
            <div class="page_info_right">
                <a href="#" class="btn btn-success add_new_pro_btn"><i class="fa fa-eye"></i>View Invoices</a>
                <a href="products.php" class="btn btn-info back_btn">Back</a>

            </div>
        </div>

        <ul class="nav nav-pills">
            <li class="active"><a data-toggle="pill" href="#home">Invoice List</a></li>
            <li><a data-toggle="pill" href="#menu1">Add Invoice</a></li>

        </ul>

        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">

                <div class="show_invoice">
                    <h4>Product List</h4>
                    <table class="table table-bordered invoice_table" id="invoice_product_data_table">
                        <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>Product Name</th>
                                <th>Type</th>
                                <th>Group</th>
                                <th>Size H</th>
                                <th>Size W</th>
                                <th>Quantity</th>
                                <th>Carton</th>
                                <th>Piece</th>
                                <th>Purchase</th>
                                <th>Subtotal</th>
                                <th>Total</td>
                                <th>Status</td>

                            </tr>
                        </thead>
                        <tbody>


                        </tbody>

                    </table>
                </div>
            </div>
            <div id="menu1" class="tab-pane fade">

                <div class="add_product">

                    <form action="" method="post">
                        <table >
                            <tr>
                                <td></td>

                                <td colspan="2">
                                    <button id=""  type="reset"  class="btn btn-danger" type="reset" data_id="1"><i class="fa fa-eraser"></i>&nbsp;Reset</button>

                                    <button id="reset_invoice_form" class="btn btn-success add_invoice_btn" value="Add Invoice" data_id="2"><i class="fa fa-plus-circle"></i>&nbsp;Add New Product</button>
                                    <button id="" class="btn btn-danger add_new_invoice_table_row" value="Add Invoice" data_id="2"><i class="fa fa-plus-circle"></i>&nbsp;Add New Row</button>


                                </td>
                            </tr>

                            <tr>
                                <td class=""  style="text-align: right;">
                                    Invoice Number
                                </td>
                                <td>
                                    <input id="invoice_number" type="text" class="form-control" >
                                </td>
                                <td style="text-align: right;">
                                    Supplier ID
                                </td>
                                <td>
                                    <select name="product_group" id="supplier" class="form-control supplier_dropdown">
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
                            </tr>
                            <tr>
                                <td class=""  style="text-align: right;">
                                    Date
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="date_input">
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
                                    Time
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="time_input">
                                </td>
                                <td style="text-align: right;">
                                    Address
                                </td>
                                <td id="supplier_address">
                                    <input id="supplier_address_data" type="text" class="form-control" >
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
                                    <input type="text" class="form-control" id="suppplier_contact_data">
                                </td>

                            </tr>

                        </table>
                    </form>

                    <table id="invoice_form_table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Group</th>
                                <th>Size H</th>
                                <th>Size W</th>
                                <th>Quantity</th>
                                <th>Carton</th>
                                <th>Piece</th>
                                <th>Purchase</th>
                                <th>Subtotal</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>
    <?php include 'lib/footer.php'; ?>