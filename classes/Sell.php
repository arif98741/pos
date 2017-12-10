<?php

include_once 'DB.php';
include_once 'Session.php';
include_once 'helper/Helper.php';

class Sell {

    private $loginObj;
    private $dbObj;
    private $helpObj;

    public function __construct() {
        $this->loginObj = new Helper();
        $this->dbObj = new DB();
        $this->helpObj = new Helper();
    }

    public function storeSellProducts($data) {
        $sell_id = $this->helpObj->validAndEscape($data['sell_id']);
        $customer_id = $this->helpObj->validAndEscape($data['customer_id']);
        $pro_id = $this->helpObj->validAndEscape($data['product_id']);
        $pro_quantity = $this->helpObj->validAndEscape($data['product_quantity']);
        $pro_piece = $this->helpObj->validAndEscape($data['product_piece']);
        $unit_price = $this->helpObj->validAndEscape($data['unit_price']);
        $sub_total = $this->helpObj->validAndEscape($data['sub_total']);
        $check_q = "select * from tbl_sell_products where sell_id='$sell_id' and product_id='$pro_id' and customer_id='$customer_id' and status ='0'";
        $check_st = $this->dbObj->select($check_q);
        if ($check_st->num_rows < 1) {
            $store_pro_q = "INSERT INTO `tbl_sell_products` (sell_id,customer_id,product_id, quantity, product_piece, unit_price,subtotal) VALUES ('$sell_id','$customer_id','$pro_id', '$pro_quantity', '$pro_piece', '$unit_price','$sub_total')";
            $insert_st = $this->dbObj->insert($store_pro_q);
            if ($insert_st) {
                return '0';
            } else {
                return "1";
            }
        }
    }

    public function showSellProducts($sell_id, $customer_id) {
        $query = "SELECT * FROM tbl_sell_products,tbl_product,tbl_group,tbl_brand WHERE tbl_product.product_group = tbl_group.groupid and tbl_sell_products.product_id = tbl_product.product_id and tbl_product.product_brand = tbl_brand.brandid and tbl_sell_products.sell_id='$sell_id' and tbl_sell_products.customer_id='$customer_id' and tbl_sell_products.status='0'  order by tbl_sell_products.serial_no asc";
        $st = $this->dbObj->select($query);
        if ($st) {
            $data = "";
            $i = $total = 0;
            $data .= "<tr>"
                    . "<th>Serial</th>"
                    . "<th>Product ID</th>"
                    . "<th>Product Group</th>"
                    . "<th>Brand</th>"
                    . "<th>Quantity</th>"
                    . "<th>Piece</th>"
                    . "<th>Unit Price</th>"
                    . "<th>Subtotal</th>"
                    . "<th>Action</th>"
                    . "</tr>";
            while ($r = $st->fetch_assoc()) {
                $i++;
                $total += $r['subtotal'];
                $data .= "<tr>";
                $data .= "<td>" . $i . "</td>"
                        . "<td>" . $r['product_id'] . "</td>"
                        . "<td>" . $r['groupname'] . "</td>"
                        . "<td>" . $r['brandname'] . "</td>"
                        . "<td>" . $r['quantity'] . "</td>"
                        . "<td>" . $r['product_piece'] . "</td>"
                        . "<td>" . $r['unit_price'] . "</td>"
                        . "<td>" . $r['subtotal'] . "</td>"
                        . "<td>" . '<i class="btn fa fa-trash remove_sell_product" product_id="' . $r['product_id'] . '"></i>' . '<i class="fa fa-pencil-square-o update_sell_product" style="cursor:pointer;" sell_product_id="' . $r['product_id'] . '" sell_sell_id="' . $r['sell_id'] . '" sell_customer_id="' . $r['customer_id'] . '"></i>' . "</td>";
                $data .= "</tr>";
            }
            $data .= "<tr style='text-align:center;'>"
                    . "<th colspan='7'>Total</th>"
                    . "<th>" . $total . "</th>"
                    . "</tr>";
            return $data;
        } else {
            return null;
        }
    }

    public function deleteSingleProduct($pro_id, $sell_id) {
        $del_query = "delete from tbl_sell_products where product_id='$pro_id' and sell_id='$sell_id' and status='0'";
        $del_st = $this->dbObj->delete($del_query);
        if ($del_st) {
            return true;
        } else {
            return false;
        }
    }

    //for calculation and getting total amount of sell products for a specific customer
    public function getTotal($data) {
        $customer_id = $this->helpObj->validAndEscape($data['customer_id']);
        $sell_id = $this->helpObj->validAndEscape($data['sell_id']);
        $tq = "select * from tbl_sell_products where status='0' and customer_id='$customer_id' && sell_id='$sell_id'";
        $stmt = $this->dbObj->select($tq);
        if ($stmt) {
            $total = 0;
            while ($r = $stmt->fetch_assoc()) {
                $total += $r['subtotal'];
            }
            return $total;
        }
    }

    public function saveSaleInvoice($data) {
        $customer_balance = $this->helpObj->validAndEscape($data['balance']);
        $sell_subtotal = $this->helpObj->validAndEscape($data['sell_subtotal']);
        //$sell_discount = $this->helpObj->validAndEscape($data['sell_discount']);
        $sell_grandtotal = $this->helpObj->validAndEscape($data['sell_grand_total']);
        $sell_paid = $this->helpObj->validAndEscape($data['sell_paid']);
        $sell_due = $this->helpObj->validAndEscape($data['sell_due']);
        $sell_id = $this->helpObj->validAndEscape($data['sell_id']);
        $customer_id = $this->helpObj->validAndEscape($data['customer_id']);
        $seller = Session::get('userid');

        $check_sell_q = "select * from tbl_sell where sell_id='$sell_id'";
        $check_sell_st = $this->dbObj->select($check_sell_q);
        if ($check_sell_st) {
            if ($check_sell_st->num_rows > 0) {
                return '<p class="alert alert-danger fadeout">There is a invoice with same id. Please give another invoice id</p>';
            }
        } else {
            $tbl_sell_insert_q = "insert into tbl_sell(sell_id,customer_id,seller,sub_total,grand_total,paid,due,updateby) values('$sell_id','$customer_id','$seller','$sell_subtotal','$sell_grandtotal','$sell_paid','$sell_due','$seller')";
            $tbl_sell_insert_st = $this->dbObj->insert($tbl_sell_insert_q);
            if ($tbl_sell_insert_st) {
                return '<p class="alert alert-success fadeout">Products Added</p>';
            } else {
                return '<p class="alert alert-danger fadeout">Products Not Added</p>';
            }
        }
    }

    //show sales list in viewsales.php
    public function showSalesList() {
        $st = $this->dbObj->select("SELECT * FROM tbl_sell,tbl_customer WHERE tbl_sell.customer_id = tbl_customer.customer_id order by tbl_sell.serial DESC");
        if ($st) {
            return $st;
        } else {
            return false;
        }
    }

    //delelte sales
    public function deleteSale($serial, $sell_id) {
        $serial = $this->helpObj->validAndEscape($serial);
        $sell_id = $this->helpObj->validAndEscape($sell_id);

        $delquery = "delete from tbl_sell where serial='$serial'";
        $st = $this->dbObj->delete($delquery);
        if ($st) {
            $in_pro_query = "select * from tbl_sell_products where sell_id='$sell_id'";
            $in_pro_st = $this->dbObj->select($in_pro_query); //delete invoice 
            if ($in_pro_st) {
                $in_pro_del_q = "delete from tbl_sell_products where sell_id='$sell_id'";
                $sell_products_st = $this->dbObj->delete($in_pro_del_q);
                if ($sell_products_st) {
                    return "<p class='alert alert-success fadeout'>Sale Deleted Successfully<p>";
                } else {
                    return "<p class='alert alert-warning fadeout'>Sale Deleted Failed<p>";
                }
            }
        }
    }

    public function showSoldProduct($sell_id) {
        $sell_id = $this->helpObj->validAndEscape($sell_id);
        $query = "SELECT * FROM tbl_sell_products,tbl_sell,tbl_product where tbl_sell_products.sell_id = tbl_sell.sell_id and tbl_sell_products.product_id = tbl_product.product_id AND tbl_sell.sell_id ='$sell_id' and tbl_sell_products.status = '0'  ORDER by tbl_sell_products.serial_no DESC";
        $stmt = $this->dbObj->select($query);
        if ($stmt) {
            $update_q = "UPDATE tbl_sell_products SET status = '0' WHERE tbl_sell_products.sell_id = '$sell_id'";
            $update_st = $this->dbObj->update($update_q);
            return $stmt;
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

    //get single sale details for editsale.php
    public function singleSale($sell_id) {
        $sell_id = $this->helpObj->validAndEscape($sell_id);
        $query = "select * from tbl_sell where sell_id='$sell_id'";
        $st = $this->dbObj->select($query);
        if ($st) {
            return $st->fetch_assoc();
        } else {
            return false;
        }
    }

    //get sold products for showing in editing table in editsale.php
    public function getSellProducts($sell_id) {
        $query = "SELECT * from tbl_sell,tbl_sell_products,tbl_customer,tbl_group,tbl_product,tbl_type WHERE 
                    tbl_sell.sell_id = tbl_sell_products.sell_id and
                    tbl_sell.customer_id = tbl_customer.customer_id AND
                    tbl_sell_products.product_id = tbl_product.product_id AND
                    tbl_product.product_type = tbl_type.typeid AND
                    tbl_product.product_group = tbl_group.groupid  AND
                    tbl_sell.sell_id='$sell_id'    AND tbl_sell_products.status='1'";

        $st = $this->dbObj->select($query);
        if ($st) {
            return $st;
        } else {
            return false;
        }
    }

    //update single product for popup in addsell.php
    public function udpateSingleProPopup($data) {
        $sell_id = $this->helpObj->validAndEscape($data['sell_id']);
        $customer_id = $this->helpObj->validAndEscape($data['cus_id']);
        $pro_id = $this->helpObj->validAndEscape($data['pro_id']);
        $pro_quantity = $this->helpObj->validAndEscape($data['quantity']);
        $pro_piece = $this->helpObj->validAndEscape($data['piece']);
        $unit_price = $this->helpObj->validAndEscape($data['unit_price']);
        $sub_total = $this->helpObj->validAndEscape($data['sub_total']);

        if ($this->helpObj->validFloat($pro_quantity)) {
            if ($this->helpObj->validFloat($pro_piece)) {
                if ($this->helpObj->validFloat($unit_price)) {
                    if ($this->helpObj->validFloat($sub_total)) {
                        $query = "UPDATE tbl_sell_products SET
                            quantity = '$pro_quantity', product_piece = '$pro_piece',    
                            unit_price = '$unit_price',  subtotal = '$sub_total'
                            where sell_id='$sell_id' and customer_id='$customer_id' and product_id='$pro_id'";
                        if (!($this->dbObj->update($query))) {
                            return "<p class='alert alert-warning'>Failed To Update Sell Product<p>";
                        } else {
                            return "<p class='alert alert-success'>Sold Product Update Successful<p>";
                        }
                    } else {
                        return "<p class='alert alert-warning'>Subtotal Must be Number<p>";
                    }
                } else {
                    return "<p class='alert alert-warning'>Unit Price Must be Number<p>";
                }
            } else {
                return "<p class='alert alert-warning'>Product Piece Must be Number<p>";
            }
        } else {
            return "<p class='alert alert-warning'>Product Quantity Must be Number<p>";
        }
    }

}
