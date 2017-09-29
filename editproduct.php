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
                <h3><i class="fa fa-chevron-circle-right"></i>&nbsp;Update Product</h3>
            </div>
            <div class="page_info_right">
                <a href="products.php" class="btn btn-success add_new_pro_btn"><i class="fa fa-eye"></i>View Products</a>
                <a href="addproduct.php" class="btn btn-info back_btn">Back</a>

            </div>
        </div>


        <div class="add_product">

            <?php
            if (isset($_GET['product_id'])) {
                $sta = $pro->getsingleProduct($_GET['product_id']);
                $data = $sta->fetch_assoc();
            } else {
                echo "<script>window.location = 'products.php';</script>";
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $update = $pro->updateProduct($_GET['product_id'], $_POST);
                if ($update) {
                    echo "<script>window.location = 'products.php';</script>";
                }
            }
            ?>

            <form action="" method="post">
                <table>
                    <tr>
                        <td>
                            <input name="product_id" class="form-control" type="text" value="<?php echo $data['product_id']; ?>" required="">
                        </td>
                        <td>
                            <select name="product_type" class="form-control">

                                <?php
                                $status = $pro->showType();
                                while ($result = $status->fetch_assoc()) {
                                    ?>
                                    <option <?php if ($data['product_type'] == $result['typeid']): ?> selected="selected" <?php endif; ?> value="<?php echo $result['typeid']; ?>"><?php echo $result['typename']; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td>
                            <select name="product_group" class="form-control">
                                <option>Select Group</option>
                                <?php
                                $status = $pro->showGroup();
                                while ($result = $status->fetch_assoc()) {
                                    ?>
                                    <option <?php if ($data['product_group'] == $result['groupid']): ?> selected="selected" <?php endif; ?>  value="<?php echo $result['groupid']; ?>"><?php echo $result['groupname']; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input name="product_name" class="form-control" type="text"  value="<?php echo $data['product_name']; ?>"  required="">
                        </td>
                        <td>
                            <select name="product_brand" class="form-control">
                                <option>Select Brand</option>
                                <?php
                                $status = $pro->showBrand();
                                while ($result = $status->fetch_assoc()) {
                                    ?>
                                    <option <?php if ($data['product_brand'] == $result['brandid']): ?> selected="selected" <?php endif; ?>  value="<?php echo $result['brandid']; ?>"><?php echo $result['brandname']; ?></option>
                                <?php } ?>
                            </select>  
                        </td>
                        <td>
                            <input name="price" class="form-control" type="number"  value="<?php echo $data['product_id']; ?>"  required="">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input name="size_h" class="form-control" type="text"  value="<?php echo $data['size_h']; ?>" required="">
                        </td>
                        <td>
                            <input  name="color" class="form-control" type="text"  value="<?php echo $data['color']; ?>" required="">
                        </td>
                        <td>
                            <input  name="unit_price" class="form-control" type="number"  value="<?php echo $data['unit_price']; ?>" required="">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input name="size_w" class="form-control" type="text"  value="<?php echo $data['size_w']; ?>" required="">
                        </td>
                        <td>
                            <input  name="piece_in_a_carton" class="form-control" type="text" value="<?php echo $data['piece_in_a_carton']; ?>" required="">
                        </td>
                        <td>
                            <input  name="purchase_price" class="form-control" type="number"  value="<?php echo $data['purchase_price']; ?>" required="">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="2">
                            <input  class="btn btn-danger" type="reset" value="Reset">
                            <input class="btn btn-success" type="submit" value="Update Product">
                        </td>
                        <td></td>
                    </tr>

                </table>
            </form>
        </div>
    </div>



    <?php include 'lib/footer.php'; ?>