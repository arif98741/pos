<?php

include_once 'DB.php';
include_once 'Session.php';
include_once 'helper/Helper.php';

class Supplier {

    private $dbObj;
    private $helpObj;

    public function __construct() {

        $this->dbObj = new DB();
        $this->helpObj = new Helper();
    }

    public function showSupplier() {
        $query = 'select * from tbl_supplier order by serial desc';
        $stmt = $this->dbObj->select($query);
        return $stmt;
    }

    public function showSupplierForDropdown() {
        $query = 'select * from tbl_supplier order by supplier_name asc';
        $stmt = $this->dbObj->select($query);
        return $stmt;
    }

    public function showSingleSupplier($id) {
        $supplier_id = $this->helpObj->validAndEscape($id);
        $query = "select * from tbl_supplier where supplier_id='$supplier_id'";
        $stmt = $this->dbObj->select($query);
        return $stmt;
    }

    public function insertSeller($data) {
        $supplier_id = $this->helpObj->validAndEscape($data['supplier_id']);
        $supplier_name = $this->helpObj->validAndEscape($data['supplier_name']);
        $address = $this->helpObj->validAndEscape($data['address']);
        $contact_no = $this->helpObj->validAndEscape($data['contact_no']);
        $contact_person = $this->helpObj->validAndEscape($data['contact_person']);
        $email = $this->helpObj->validAndEscape($data['email']);
        $opening_balance = $this->helpObj->validAndEscape($data['opening_balance']);
        $remark = $this->helpObj->validAndEscape($data['remark']);

        $query = "insert into tbl_supplier(
             supplier_id, supplier_name, address,
             contact_no, contact_person, email,
            opening_balance,remark) 
            values('$supplier_id', '$supplier_name', '$address',
            '$contact_no', '$contact_person', '$email',
            '$opening_balance','$remark')";

        $check = $this->dbObj->select("select * from tbl_supplier where supplier_id='$supplier_id'");

        if ($check) {
            return "Supplier Already Exist";
        } else {
            $sta = $this->dbObj->insert($query);
            if ($sta) {
                return "Data Inserted Successfully";
            } else {
                return "Data Inserted Failed";
            }
        }
    }

    public function singleSupplier($supplier_id) {
        $supplier_id = $this->helpObj->validAndEscape($supplier_id);
        $query = "select * from tbl_supplier where supplier_id='$supplier_id'";
        $sta = $this->dbObj->select($query);
        return $sta;
    }

    public function updateSupplier($data) {
        $serial = $this->helpObj->validAndEscape($data['serial']);
        $supplier_id = $this->helpObj->validAndEscape($data['supplier_id']);
        $supplier_name = $this->helpObj->validAndEscape($data['supplier_name']);
        $address = $this->helpObj->validAndEscape($data['address']);
        $contact_no = $this->helpObj->validAndEscape($data['contact_no']);
        $contact_person = $this->helpObj->validAndEscape($data['contact_person']);
        $email = $this->helpObj->validAndEscape($data['email']);
        $message = "";

        $query = "UPDATE tbl_supplier
                            SET
                            supplier_id = '$supplier_id',
                            supplier_name = '$supplier_name',    
                            address = '$address',    
                            contact_no = '$contact_no',    
                            contact_person = '$contact_person',
                            email = '$email'
                            where serial='$serial' ";
        return $stmt = $this->dbObj->update($query);
    }

    public function selectSupplier($data) {
        $serial = $this->helpObj->validAndEscape($data['serial']);
        $supplier_id = $this->helpObj->validAndEscape($data['supplier_id']);
        $query = "delete from tbl_supplier where serial='$serial'";
        $sta = $this->dbObj->delete($query);
        if ($sta) {
            return true;
        } else {
            return false;
        }
    }

}
