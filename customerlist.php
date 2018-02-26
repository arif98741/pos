<?php include 'lib/header.php'; ?>
<style>
    td{
        padding: 15px;
    }

</style>

<?php
$msg = '';

if (isset($_POST['update'])) {
    $msg = $cus->updateCustomer($_POST);
}

if (isset($_GET['action']) && isset($_GET['serial'])) {
    $msg = $cus->deleteCustomer($_GET);
}
?>
<div class="container">

    <div class="content_section">
        <?php if (isset($msg) && $msg != ''): ?>
            <?php echo $msg; ?>
        <?php endif; ?>

        <div class="page_info">
            <div class="page_info_left">
                <h3><i class="fa fa-chevron-circle-right"></i>&nbsp;Customer List</h3>
            </div>
            <div class="page_info_right">
                <a href="addcustomer.php" class="btn btn-success add_new_pro_btn"><i class="fa fa-plus"></i>Add New Customer</a>
                <a href="#" class="btn btn-info back_btn">Back</a>

            </div>
        </div>


        <div class="add_product" id="add_product">



            <table id="customer_table" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Customer ID</th>
                        <th>Customer Name</th>
                        <th>Address</th>
                        <th>Contact No</th>
                        <th>Email</th>
                        <th>Opening Balance</th>
                        <th>Discount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody style="text-align: center;">
                    <?php
                    $cust_stmt = $db->select("select * from tbl_customer order by serial desc");
                    ?>
                    <?php
                    if ($cust_stmt):
                        ?>
                        <?php while ($r = $cust_stmt->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $r['customer_id']; ?></td>
                                <td><?php echo $r['customer_name']; ?></td>
                                <td><?php echo $r['address']; ?></td>
                                <td><?php echo $r['contact_no']; ?></td>
                                <td><?php echo $r['email']; ?></td>
                                <td><?php echo $r['opening_balance']; ?></td>
                                <td><?php echo $r['discount']; ?></td>
                                <td>
                                    <a href="viewcustomer.php?action=view&serial=<?php echo $r['serial']; ?>&customer_id=<?php echo $r['customer_id']; ?>"><i class="fa fa-eye" title="view supplier information"></i></a>&nbsp;
                                    <a href="editcustomer.php?action=edit&serial=<?php echo $r['serial']; ?>&customer_id=<?php echo $r['customer_id']; ?>"><i class="fa fa-pencil-square-o" title="click to edit"></i></a>
                                    <a href="?action=delete&serial=<?php echo $r['serial']; ?>&customer_id=<?php echo $r['customer_id']; ?>"><i id="deleterow"  rowid="<?php echo $result['serial']; ?>" class="fa fa-trash btn" style="color:red;" title="click to delete" onclick="return confirm('are you sure to delete?')" ></i></a>
                                </td>

                            </tr>
                        <?php endwhile; ?>

                    <?php else: ?>
                        <tr>
                            <td colspan="9" style="text-align: center;">No Customer Data Found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>

            </table>

        </div>
    </div>


    <?php include 'lib/footer.php'; ?>