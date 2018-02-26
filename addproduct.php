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
                <h3><i class="fa fa-chevron-circle-right"></i>&nbsp;Add New Product</h3>
            </div>
            <div class="page_info_right">
                <a href="products.php" class="btn btn-success add_new_pro_btn"><i class="fa fa-eye"></i>View Products</a>
                <a href="products.php" class="btn btn-info back_btn">Back</a>

            </div>
        </div>


        <div class="add_product">

            <form action="products.php" method="post">
                <table >
                    <tr>
                        <td>
                            <input name="product_id" class="form-control" type="text" placeholder="Product ID" required="">
                        </td>
                        <td>
                            <select name="product_type" class="form-control">
                                <option>Select Type</option>
                                <?php
                                $status = $pro->showType();
                                while ($result = $status->fetch_assoc()) {
                                    ?>
                                    <option value="<?php echo $result['typeid']; ?>"><?php echo $result['typename']; ?></option>
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
                                    <option value="<?php echo $result['groupid']; ?>"><?php echo $result['groupname']; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input name="product_name" class="form-control" type="text" placeholder="Product Name"  required="">
                        </td>
                        <td>
                            <select name="product_brand" class="form-control">
                                <option>Select Brand</option>
                                <?php
                                $status = $pro->showBrand();
                                while ($result = $status->fetch_assoc()) {
                                    ?>
                                    <option value="<?php echo $result['brandid']; ?>"><?php echo $result['brandname']; ?></option>
                                <?php } ?>
                            </select>  
                        </td>
                        <td>
                            <input name="price" class="form-control" type="number" placeholder="Price"  required="">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input name="size_h" class="form-control" type="text" placeholder="Size H"  required="">
                        </td>
                        <td>
                            <input  name="color" class="form-control" type="text" placeholder="Color"  required="">
                        </td>
                        <td>
                            <input  name="unit_price" class="form-control" type="number" placeholder="Unit Price" required="">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input name="size_w" class="form-control" type="text" placeholder="Size W" required="">
                        </td>
                        <td>
                            <input  name="piece_in_a_carton" class="form-control" type="number" placeholder="Piece in a carton" required="">
                        </td>
                        <td>
                            <input  name="purchase_price" class="form-control" type="number" placeholder="Purchase Price" required="">
                        </td>
                    </tr>
                    <tr>
                        <td></td>

                        <td colspan="2">
                            <input  class="btn btn-danger" type="reset" value="Reset">
                            <input class="btn btn-success" type="submit" value="Add Product">
                        </td>
                    </tr>


                </table>
            </form>
        </div>


    </div>
    <?php include 'lib/footer.php'; ?>