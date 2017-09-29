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
                <h3><i class="fa fa-chevron-circle-right"></i>&nbsp;Update Supplier</h3>
            </div>
            <div class="page_info_right">
                <a href="supplierlist.php" class="btn btn-success add_new_pro_btn"><i class="fa fa-eye"></i>View Suppliers</a>
                <a href="#" class="btn btn-info back_btn">Back</a>

            </div>
        </div>


        <div class="add_product" >

            <?php
            if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['supplier_id'])) {

                $st = $sup->singleSupplier($_GET['supplier_id']);
                if ($st) {
                    $result = $st->fetch_assoc();
                    ?>
                    <form action="supplierlist.php" method="post">
                        <table id="supplier_table">
                            <tr>
                                <td>
                                    <input  name="supplier_id"  class="form-control" type="text"  value="<?php echo $result['supplier_id']; ?>" required="">
                                </td>
                                <td>
                                    <input  name="supplier_name" class="form-control" type="text" value="<?php echo $result['supplier_name']; ?>" required="">
                                </td>
                                <td>
                                    <input  name="address" class="form-control" type="text" value="<?php echo $result['address']; ?>"  required=""> 

                                </td>
                                <td>
                                    <input  name="contact_no" class="form-control" type="text" value="<?php echo $result['contact_no']; ?>"  required="">
                                </td>
                            </tr>

                            <tr>

                                <td>
                                    <input   name="contact_person" class="form-control" type="text" value="Contact Person" required="">
                                </td>
                                <td>

                                    <input   name="email" class="form-control" type="text" value="<?php echo $result['email']; ?>"  required="">

                                </td>
                                <td>
                                    <input  name="opening_balance" class="form-control" type="text" value="Opening Balance" required="">
                                </td>
                                <td>
                                    <input  name="remark" class="form-control" type="text" value="Remark" required="">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">

                                    <input name="serial"  class="btn btn-danger" type="hidden" value="<?php echo $result['serial']; ?>">

                                </td>
                                <td></td>


                                <td colspan="3">
                                    <input  class="btn btn-danger" type="reset" value="Reset">
                                    <input class="btn btn-success" name="submit" type="submit" value="Update Supplier">
                                </td>
                                <td></td>
                            </tr>

                        </table>
                    </form>

                    <?php
                } else {
                    echo "<p class='alert alert-danger'>No Supplier Found To Edit</p>";
                }
            } else {
                echo "<p class='alert alert-danger'>Invalid URL</p>";
            }
            ?>



        </div>
    </div>


    <?php include 'lib/footer.php'; ?>