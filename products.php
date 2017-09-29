<?php include 'lib/header.php'; ?>
<?php
//code for adding product to database
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = $pro->addProduct($_POST);
}
?>


<div class="container">
    <div class="content_section">
        <div class="page_info">
            <div class="page_info_left">
                <h3><i class="fa fa-chevron-circle-right"></i>&nbsp;Data Results For Products</h3>
            </div>
            <div class="page_info_right">
                <a href="addproduct.php" class="btn btn-success add_new_pro_btn"><i class="fa fa-plus"></i> Add New Product</a>
                <a href="addproduct.php" class="btn btn-info back_btn">Back</a>

            </div>
        </div>

        <?php
        if (isset($_GET['product_id'])) {
            $sta = $pro->deleteProduct($_GET['product_id']);
            if ($sta) {
                echo "<script>window.location = 'products.php';</script>";
            } else {
                echo "<script>window.location = 'products.php';</script>";
            }
        }
        ?>

        <table class="table-bordered  display" id="product_table" width="100%">
            <thead>
                <tr>
                    <th># ID</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Group</th>
                    <th>Brand</th>
                    <th>Size H</th>
                    <th>Size W</th>
                    <th>Color</th>
                    <th>Price</th>
                    <th>Last Update</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($message)) {
                    echo "<tr style='background: #ddd;'>";
                    echo "<td colspan='12'>" . "Product Already Exist" . "</td>";
                    echo "</tr>";
                }
                $status = $pro->showProduct();

                if ($status) {

                    while ($result = $status->fetch_assoc()) {
                        ?>
                        <tr style="text-align: center;" id="rowid-<?php echo $result['serial']; ?>">
                            <td><?php echo $result['product_id']; ?></td>
                            <td><?php echo $result['product_name']; ?></td>
                            <td><?php echo $result['typename']; ?></td>
                            <td><?php echo $result['groupname']; ?></td>
                            <td><?php echo $result['brandname']; ?></td>
                            <td><?php echo $result['size_h']; ?></td>
                            <td><?php echo $result['size_w']; ?></td>
                            <td><?php echo $result['color']; ?></td>
                            <td><?php echo $result['price'] . ".00"; ?></td>
                            <td><?php echo $help->formatDate($result['last_update'], 'd-m-Y g:ia'); ?></td>
                            <td>
                                <a href="editproduct.php?product_id=<?php echo $result['serial']; ?>" class="btn" style="border-radius: 3px;" title="click to edit" ><i class="fa fa-pencil"></i></a>
                                <a href="?product_id=<?php echo $result['serial']; ?>" class="btn" style="border-radius: 3px;" title="click to delete" onclick="return confirm('are you sure to delete?')" id="rowdelete" delid="<?php echo $result['serial']; ?>"><i class="fa fa-trash"></i></a>
                            </td>

                        </tr>

                        <?php
                    }
                } else {
                    ?>

                <?php }
                ?>
            </tbody>
        </table>
    </div>



    <?php include 'lib/footer.php'; ?>