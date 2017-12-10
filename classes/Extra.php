<?php

include_once 'DB.php';
include_once 'helper/Helper.php';

class Extra {

    private $dbObj;
    private $helpObj;

    public function __construct() {

        $this->dbObj = new DB();
        $this->helpObj = new Helper();
    }

    public function showGroup() { //for showing group in dropdown in addinvoice.php
        $query = 'select * from tbl_group order by groupname ASC';
        $stmt = $this->dbObj->select($query);
        $val = '<select class="form-control product_group" name="product_group">';
        if ($stmt->num_rows > 0) {
            $val .= '<option>Select</option>';
            while ($r = $stmt->fetch_assoc()) {
                $val .= '<option value="' . $r['groupid'] . '">' . $r['groupname'] . '</option>';
            }
        }
        return $val .= '</select>';
    }

    //for showing products name list according to group id in dropdown in addinvoice.php
    public function showProductNameList($group_id) {
        $group_id = $this->helpObj->validAndEscape($group_id);
        $query = "SELECT * from tbl_product WHERE product_group='$group_id' order by product_name asc";
        $stmt = $this->dbObj->select($query);
        $val = '<select class="form-control product_list" name="product_name">';
        if ($stmt) {
            $val .= '<option>Select</option>';
            while ($r = $stmt->fetch_assoc()) {
                $val .= '<option value="' . $r['product_id'] . '">' . $r['product_name'] . '</option>';
            }
            return $val .= '</select>';
        } else {
            $return = '';
            $return .= '<select  class="form-control">'
                    . '<option>Select</option>'
                    . '</select';
            return $return;
        }
    }

    //showing single product details in addinvoice form by selecting product list dropdown
    public function showSingleProDetails($pro_id) {
        $q = "select * from tbl_product where product_id ='$pro_id'";
        $st = $this->dbObj->select($q);
        $data = '';
        if ($st) {
            return $st->fetch_assoc();
        } else {
            
        }
    }

}
