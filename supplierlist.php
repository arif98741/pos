<?php echo include 'lib/header.php'; ?>
<?php
$msg = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['supplier_id']) && isset($_POST['submit'])) {
    $msg = $sup->updateSupplier($_POST);
}
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $sup->deleteSupplier($_GET);
}
?>
<div class="container">
    <div class="content_section">
        <div class="page_info">
            <div class="page_info_left">
                <h3><i class="fa fa-chevron-circle-right"></i>&nbsp;Supplier List</h3>
            </div>
            <div class="page_info_right">
                <a href="addsupplier.php" class="btn btn-success add_new_pro_btn"><i class="fa fa-plus"></i>&nbsp;Add New Supplier</a>
                <a href="addproduct.php" class="btn btn-info back_btn">Back</a>

            </div>
        </div>
        <?php if (isset($msg) && $msg != ''): ?>
            <?php echo $msg; ?>
        <?php endif; ?>



        <table class="table-bordered table display" id="supplier_list_table" width="100%">
            <thead>
                <tr>
                    <th>Supplier ID</th>
                    <th>Suppler Name</th>
                    <th>Address</th>
                    <th>Contact No.</th>
                    <th>Opening Balance</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($stmt = $sup->showSupplier()): ?>
                    <?php while ($result = $stmt->fetch_assoc()): ?>
                        <tr style="text-align:center;"  id="rownumber<?php echo $result['serial']; ?>" class="data">
                            <td><?php echo $result['supplier_id']; ?></td>
                            <td><?php echo $result['supplier_name']; ?></td>
                            <td><?php echo $result['address']; ?></td>
                            <td><?php echo $result['contact_no']; ?></td>
                            <td><?php echo $result['opening_balance']; ?></td>
                            <td>
                                <a href="viewsupplier.php?action=view&serial=<?php echo $result['serial']; ?>&supplier_id=<?php echo $result['supplier_id']; ?>"><i class="fa fa-eye" title="view supplier information"></i></a>&nbsp;&nbsp;
                                <a href="editsupplier.php?action=edit&serial=<?php echo $result['serial']; ?>&supplier_id=<?php echo $result['supplier_id']; ?>"><i class="fa fa-pencil-square-o" title="click to edit"></i></a>
                                <a href="?action=delete&serial=<?php echo $result['serial']; ?>&supplier_id=<?php echo $result['supplier_id']; ?>"><i id="deleterow"  rowid="<?php echo $result['serial']; ?>" class="fa fa-trash btn" style="color:red;" title="click to delete" onclick="return confirm('are you sure to delete?')" ></i></a>
                            </td>

                        </tr>
                    <?php endwhile; ?>
                <?php endif; ?>
            </tbody>

        </table>
    </div>

    <?php echo include 'lib/footer.php'; ?>
