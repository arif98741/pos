<?php

include_once 'Session.php';
include_once 'DATABASE.php';
include_once 'helper/Helper.php';

class Customer {

    private $dbObj;
    private $helpObj;

    public function __construct() {

        $this->dbObj = new DATABASE();
        $this->helpObj = new Helper();
    }

    //showing customer list in addsell.php in dropdown menu.

    public function showCustomerForDropdown() {
        $query = 'select * from tbl_customer order by customer_name asc';
        $stmt = $this->dbObj->select($query);
        if ($stmt) {
            return $stmt;
        } else {
            return false;
        }
    }

    //show single customer details for dropdown in addsell.php
    public function singleCustomerDetail($customer_id) {
        $query = "select * from tbl_customer where customer_id='$customer_id'";
        $stmt = $this->dbObj->select($query);
        if ($stmt) {
            $val = $stmt->fetch_array();
            return json_encode($val);
        } else {
            return false;
        }
    }

    public function insertCustomer($data) {
        $customer_id = $this->helpObj->validAndEscape($data['customer_id']);
        $customer_name = $this->helpObj->validAndEscape($data['customer_name']);
        $address = $this->helpObj->validAndEscape($data['address']);
        $contact_no = $this->helpObj->validAndEscape($data['contact_no']);
        //$contact_person = $this->helpObj->validAndEscape($data['contact_person']);
        $email = $this->helpObj->validAndEscape($data['email']);
        $opening_balance = $this->helpObj->validAndEscape($data['opening_balance']);
        $remark = $this->helpObj->validAndEscape($data['remark']);
        $discount = $this->helpObj->validAndEscape($data['discount']);
        $updateby = Session::get('userid');
        $query = "insert into tbl_customer(
             customer_id, customer_name, address,contact_no,email,
            opening_balance,remark,discount,updateby) 
            values('$customer_id', '$customer_name', '$address',
            '$contact_no','$email',
            '$opening_balance','$remark','$discount','$updateby')";

        $check = $this->dbObj->select("select * from tbl_customer where customer_id='$customer_id'");

        if ($this->helpObj->validEmail($email)) {
            if ($this->helpObj->validFloat($discount)) {
                if ($this->helpObj->validFloat($opening_balance)) {
                    if ($check) {
                        return "Customer Already Exist";
                    } else {
                        $sta = $this->dbObj->insert($query);
                        if ($sta) {
                            return "Customer Added Successfully";
                        } else {
                            return "Customer Inserted Fail";
                        }
                    }
                } else {
                    return 'Opening Balance Must be Number Value';
                }
            } else {
                return 'Discount Must be Number Value';
            }
        } else {
            return 'Email Invalid Address';
        }
    }

    public function singleCustomer($customerid) {
        $customerid = $this->helpObj->validAndEscape($customerid);
        $query = "select * from tbl_customer where customer_id='$customerid'";
        $sta = $this->dbObj->select($query);
        return $sta;
    }

    public function updateCustomer($data) {
        $serial = $this->helpObj->validAndEscape($data['serial']);
        //$customerid = $this->helpObj->validAndEscape($data['customer_id']);
        $customername = $this->helpObj->validAndEscape($data['customer_name']);
        $address = $this->helpObj->validAndEscape($data['address']);
        $contact_no = $this->helpObj->validAndEscape($data['contact_no']);
        $email = $this->helpObj->validAndEscape($data['email']);
        $remark = $this->helpObj->validAndEscape($data['remark']);
        $discount = $this->helpObj->validAndEscape($data['discount']);
        $updateby = Session::get('userid');
        $query = "UPDATE tbl_customer SET
                            customer_name = '$customername', address = '$address',    
                            contact_no = '$contact_no',  email = '$email',
                            remark = '$remark',discount = '$discount', updateby = '$updateby'    
                            where serial='$serial'";
        $stmt = $this->dbObj->update($query);
        if ($stmt) {
            return "<p class='alert alert-success fadeout'>Customer Update Successful<p>";
        } else {
            return "<p class='alert alert-danger fadeout'>Customer Update Failed<p>";
        }
    }

    public function deleteCustomer($data) {
        $serial = $this->helpObj->validAndEscape($data['serial']);
        $query = "delete from tbl_customer where serial='$serial'";
        $sta = $this->dbObj->delete($query);
        if ($sta) {
            return "<p class='alert alert-success fadeout'>Customer Deleted Successful<p>";
        } else {
            return "<p class='alert alert-danger fadeout'>Customer Deleted Failed<p>";
        }
    }

    //add popup customer from addsell.php
    public function addPopCustomer($data) {
        $customer_id = $this->helpObj->validAndEscape($data['cus_id']);
        $customer_name = $this->helpObj->validAndEscape($data['cus_name']);
        $address = $this->helpObj->validAndEscape($data['cus_addr']);
        $contact_no = $this->helpObj->validAndEscape($data['cus_contact']);
        $email = $this->helpObj->validAndEscape($data['cus_email']);
        $opening_balance = $this->helpObj->validAndEscape($data['cus_opening_bal']);
        $remark = $this->helpObj->validAndEscape($data['cus_remark']);
        $discount = $this->helpObj->validAndEscape($data['cus_discount']);
        $updateby = Session::get('userid');
        $check = $this->dbObj->select("select * from tbl_customer where customer_id='$customer_id'");
        if ($this->helpObj->validEmail($email)) {
            if ($this->helpObj->validFloat($discount)) {
                if ($this->helpObj->validFloat($opening_balance)) {
                    if ($check) {
                        return '<p class="alert alert-danger">Customer Already Exist.Plese Select Another ID</p>';
                    } else {
                        $query = "insert into tbl_customer(customer_id, customer_name, address,contact_no,email,opening_balance,remark,discount,updateby) 
            values('$customer_id', '$customer_name', '$address','$contact_no','$email',
            '$opening_balance','$remark','$discount','$updateby')";
                        $st = $this->dbObj->insert($query);
                        if ($st) {
                            return '<p class="alert alert-success">Customer Inserted Successful</p>';
                        } else {
                            return '<p class="alert alert-danger">Customer Inserted Failed</p>';
                        }
                    }
                } else {
                    return '<p class="alert alert-danger">Opening Balance Must be Number Value</p>';
                }
            } else {
                return '<p class="alert alert-danger">Discount Must be Number Value</p>';
            }
        } else {
            return '<p class="alert alert-danger">Email Invalid Address</p>';
        }
    }

    //show customers in addsell dropdown after adding from popup
    public function getPopCustomers() {
        $query = 'select * from tbl_customer order by customer_name asc';
        $stmt = $this->dbObj->select($query);
        if ($stmt) {
            $v = '<option>Select</option>';
            while ($r = $stmt->fetch_assoc()) {
                $v .= '<option value"' . $r['customer_id'] . '">' . $r['customer_name'] . '</option>';
            }
            return $v;
        } else {
            return "<option>Select</option>";
        }
    }

}
