<?php include 'lib/header.php'; ?>
<style>
    td{
        padding: 15px;
    }

</style>

<div class="container">

    <div class="content_section">

        <?php if (isset($_GET['serial']) && isset($_GET['customer_id']) && isset($_GET['action'])): ?>
            <?php
            $serial = $help->validAndEscape($_GET['serial']);
            $customer_id = $help->validAndEscape($_GET['customer_id']);
            $single_cus_q = "select * from tbl_customer where serial='$serial' and customer_id='$customer_id'";
            $single_cus_st = $db->link->query($single_cus_q);
            ?>
            <?php if ($single_cus_st): ?>
                <?php $result = $single_cus_st->fetch_assoc(); ?>
            <?php endif; ?>
        <?php else: ?>
            <p class="alert alert-danger fadeout">Invalid Url</p>
        <?php endif; ?>
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


            <form action="customerlist.php" method="post" id="customer_information_form">
                <table id="customer_table">
                    <tr>
                        <td>
                            <input name="customer_id" id="customerid"  class="form-control" type="text" value="<?php echo $result['customer_id']; ?>" readonly="">
                            <input name="serial" id="customerid"  class="form-control" type="hidden" value="<?php echo $result['serial']; ?>" readonly="">

                        </td>
                        <td>
                            <input name="customer_name" id="customername" class="form-control" type="text" placeholder="Customer Name" value="<?php echo $result['customer_name']; ?>"  required="">
                        </td>
                        <td>
                            <input name="address" id="address" class="form-control" type="text"  placeholder="Address"  value="<?php echo $result['address']; ?>" required="">

                        </td>
                        <td>
                            <input name="contact_no" id="contactno" class="form-control" type="text" placeholder="Contact No." value="<?php echo $result['contact_no']; ?>"  required="">
                        </td>
                    </tr>

                    <tr>

                        <td>
                            <input name="discount" id="discount" class="form-control" type="text" placeholder="Discount" value="<?php echo $result['discount']; ?>" >
                        </td>
                        <td>

                            <input  name="email" id="email" class="form-control" type="text" placeholder="Email"  value="<?php echo $result['email']; ?>"   required="">

                        </td>
                        <td>
                            <input  name="opening_balance" id="opening_balance" class="form-control" type="text" placeholder="Opening Balance"  value="<?php echo $result['opening_balance']; ?>"  required="">
                        </td>
                        <td>
                            <input  name="remark" id="remark" class="form-control" type="text" placeholder="Remark" value="<?php echo $result['remark']; ?>"  required="">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2" id="">
                            <p class="alert alert-danger" id="addcustomer_form_message" style="display:none;">Field Must Not Be Empty</p>
                        </td>
                        <td></td>


                        <td colspan="3">
                            <input  class="btn btn-danger" type="reset" value="Reset">
                            <input class="btn btn-success" type="submit" name="update" value="Update Customer">
                        </td>
                        <td></td>
                    </tr>

                </table>
            </form>
        </div>
    </div>


    <?php include 'lib/footer.php'; ?>