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
                <h3><i class="fa fa-chevron-circle-right"></i>&nbsp;Add New Supplier</h3>
            </div>
            <div class="page_info_right">
                <a href="supplierlist.php" class="btn btn-success add_new_pro_btn"><i class="fa fa-eye"></i>View Suppliers</a>
                <a href="#" class="btn btn-info back_btn">Back</a>

            </div>
        </div>


        <div class="add_product" id="add_product">


            <form method="post" id="supplier_information_form">
                <table id="supplier_table">
                    <tr>
                        <td>
                            <input name="supplier_id" id="supplier_id"  class="form-control" type="text" placeholder="Supplier ID" required="">
                        </td>
                        <td>
                            <input name="supplier_name" id="supplier_name" class="form-control" type="text" placeholder="Supplier Name" required="">
                        </td>
                        <td>
                            <input name="address" id="address" class="form-control" type="text" placeholder="Address"  required="">

                        </td>
                        <td>
                            <input name="contact_no" id="contact_no" class="form-control" type="text" placeholder="Contact No"  required="">
                        </td>
                    </tr>

                    <tr>

                        <td>
                            <input  name="contact_person" id="contact_person" class="form-control" type="text" placeholder="Contact Person" required="">
                        </td>
                        <td>

                            <input  name="email" id="email" class="form-control" type="text" placeholder="Email"  required="">

                        </td>
                        <td>
                            <input  name="opening_balance" id="opening_balance" class="form-control" type="text" placeholder="Opening Balance" required="">
                        </td>
                        <td>
                            <input  name="remark" id="remark" class="form-control" type="text" placeholder="Remark" required="">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p class="alert alert-danger" id="addsupplier_form_message" style="display:none;">Field Must Not Be Empty</p>
                        </td>
                        <td></td>


                        <td colspan="3">
                            <input  class="btn btn-danger" type="reset" value="Reset">
                            <input id="add_supplier" class="btn btn-success" value="Add Supplier">
                        </td>
                        <td></td>
                    </tr>

                </table>
            </form>
        </div>
    </div>


    <?php include 'lib/footer.php'; ?>