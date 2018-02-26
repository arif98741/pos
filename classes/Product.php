<?php

include_once 'DB.php';
include_once 'Session.php';
include_once 'helper/Helper.php';

class Product {

    private $loginObj;
    private $dbObj;
    private $helpObj;

    public function __construct() {
        $this->loginObj = new Helper();
        $this->dbObj = new DB();
        $this->helpObj = new Helper();
    }

    public function showType() { //for showing type in dropdown in addproduct.php
        $query = 'select * from tbl_type order by typename ASC';
        $stmt = $this->dbObj->select($query);
        return $stmt;
    }

    public function showSingleType($typeid) {
        $tstmt = $this->dbObj->select("select * from tbl_type where typeid='$typeid'");
        $trdata = $tstmt->fetch_assoc();
        return $trdata;
    }

    public function showGroup() { //for showing group in dropdown in addproduct.php
        $query = 'select * from tbl_group order by groupname ASC';
        $stmt = $this->dbObj->select($query);
        return $stmt;
    }

    public function showSingleGroup($grid) {
        $grstmt = $this->dbObj->select("select * from tbl_group where groupid='$grid'");
        $grdata = $grstmt->fetch_assoc();
        return $grdata;
    }

    public function showBrand() { //for showing brand in dropdown in addproduct.php
        $query = 'select * from tbl_brand order by brandname ASC';
        $stmt = $this->dbObj->select($query);
        return $stmt;
    }

    public function showColor() { //for showing color in dropdown in addproduct.php
        $query = 'select * from tbl_color order by colorname ASC';
        $stmt = $this->dbObj->select($query);
        return $stmt;
    }

    public function showProduct() {
        $query = 'SELECT * from 
        tbl_product, 
        tbl_brand, 
        tbl_group,
        tbl_type where
        tbl_product.product_type = tbl_type.typeid and 
        tbl_group.groupid = tbl_product.product_group  and
        tbl_brand.brandid = tbl_product.product_brand
          ORDER by tbl_product.serial desc';
        $stmt = $this->dbObj->select($query);
        return $stmt;
    }

    public function addProduct($data) {

        $product_id = $this->helpObj->validAndEscape($data['product_id']);
        $product_type = $this->helpObj->validAndEscape($data['product_type']);
        $product_group = $this->helpObj->validAndEscape($data['product_group']);
        $product_name = $this->helpObj->validAndEscape($data['product_name']);
        $product_brand = $this->helpObj->validAndEscape($data['product_brand']);
        $size_h = $this->helpObj->validAndEscape($data['size_h']);
        $size_w = $this->helpObj->validAndEscape($data['size_w']);
        $color = $this->helpObj->validAndEscape($data['color']);
        $price = $this->helpObj->validAndEscape($data['price']);
        $unit_price = $this->helpObj->validAndEscape($data['unit_price']);
        $purchase_price = $this->helpObj->validAndEscape($data['purchase_price']);
        $piece_in_a_carton = $this->helpObj->validAndEscape($data['piece_in_a_carton']);
        $u_id = $_SESSION['userid'];
        $query = "insert into tbl_product
                (product_id,product_type,product_group,product_name,product_brand,size_h,size_w,color,price,unit_price,purchase_price,piece_in_a_carton,updateby)
   
          values('$product_id','$product_type','$product_group','$product_name','$product_brand','$size_h','$size_w','$color','$price','$unit_price','$purchase_price','$piece_in_a_carton','$u_id')";

        $check = $this->dbObj->select("select * from tbl_product where product_id='$product_id'");

        if ($check) {
            return "<p class='alert alert-danger fadeout'>Product Already Exist<p>";
        } else {
            $status = $this->dbObj->insert($query);
            if ($status) {
                return "<p class='alert alert-success fadeout'>Product Insert Successful<p>";
                ;
            } else {
                return "<p class='alert alert-danger fadeout'>Failed To Insert Product<p>";
            }
        }
    }

    public function deleteProduct($product_id) {
        $product_id = $this->helpObj->validAndEscape($product_id);
        $query = "delete from tbl_product where serial='$product_id'";
        $sta = $this->dbObj->delete($query);
        if ($sta) {
            return true;
        } else {
            return false;
        }
    }

    public function getsingleProduct($product_id) {
        $product_id = $this->helpObj->validAndEscape($product_id);
        $query = "select * from tbl_product where serial='$product_id'";
        $sta = $this->dbObj->select($query);
        return $sta;
    }

    public function updateProduct($id, $data) {
        $id = $this->helpObj->validAndEscape($id);
        $product_id = $this->helpObj->validAndEscape($data['product_id']);
        $product_type = $this->helpObj->validAndEscape($data['product_type']);
        $product_group = $this->helpObj->validAndEscape($data['product_group']);
        $product_name = $this->helpObj->validAndEscape($data['product_name']);
        $product_brand = $this->helpObj->validAndEscape($data['product_brand']);
        $size_h = $this->helpObj->validAndEscape($data['size_h']);
        $size_w = $this->helpObj->validAndEscape($data['size_w']);
        $color = $this->helpObj->validAndEscape($data['color']);
        $price = $this->helpObj->validAndEscape($data['price']);
        $unit_price = $this->helpObj->validAndEscape($data['unit_price']);
        $purchase_price = $this->helpObj->validAndEscape($data['purchase_price']);
        $piece_in_a_carton = $this->helpObj->validAndEscape($data['piece_in_a_carton']);
        $u_id = $_SESSION['userid'];
        $last_update = date('current_timestamp'); //set default time at Asia/Dhaka on header.php

        $query = "UPDATE tbl_product
                            SET
                            product_id = '$product_id',
                            product_type = '$product_type',    
                            product_group = '$product_group',    
                            product_name = '$product_name',    
                            product_brand = '$product_brand',    
                            size_h = '$size_h',
                            size_w = '$size_w',
                            color = '$color',
                            price = '$price',
                            unit_price = '$unit_price',
                            purchase_price = '$purchase_price',    
                            piece_in_a_carton = '$piece_in_a_carton',   
                            last_update   ='$last_update',
                            updateby ='$u_id'    
                            where serial='$id' ";

        $sta = $this->dbObj->update($query);
        if ($sta) {
            return true;
        } else {
            echo "Update Failed";
        }
    }

}
