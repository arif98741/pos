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
                <h3><i class="fa fa-chevron-circle-right"></i>&nbsp;Add New Customer</h3>
            </div>
            <div class="page_info_right">
                <a href="customerlist.php" class="btn btn-success add_new_pro_btn"><i class="fa fa-eye"></i>View Customer</a>
                <a href="#" class="btn btn-info back_btn">Back</a>

            </div>
        </div>


        <div class="add_product" id="add_product">


            <form action="" method="post" id="customer_information_form">
                <table id="customer_table">
                    <tr>
                        <td>
                            <input name="customer_id" id="customerid"  class="form-control" type="text" placeholder="Customer ID" required="">
                        </td>
                        <td>
                            <input name="customer_name" id="customername" class="form-control" type="text" placeholder="Customer Name" required="">
                        </td>
                        <td>
                            <input name="address" id="address" class="form-control" type="text" placeholder="Address"  required="">

                        </td>
                        <td>
                            <input name="contact_no" id="contactno" class="form-control" type="text" placeholder="Contact No"  required="">
                        </td>
                    </tr>

                    <tr>

                        <td>
                            <input name="discount" id="discount" class="form-control" type="text" placeholder="Discount">
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
                        <td colspan="2" id="">
                            <p class="alert alert-danger" id="addcustomer_form_message" style="display:none;">Field Must Not Be Empty</p>
                        </td>
                        <td></td>


                        <td colspan="3">
                            <input  class="btn btn-danger" type="reset" value="Reset">
                            <input id="add_customer" class="btn btn-success add_customer" value="Add customer">
                        </td>
                        <td></td>
                    </tr>

                </table>
            </form>
        </div>
    </div>


    <?php include 'lib/footer.php'; ?>