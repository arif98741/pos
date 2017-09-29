<?php

include_once 'DB.php';
include_once 'Session.php';
include_once 'helper/Helper.php';

class Invoice {

    private $dbObj;
    private $helpObj;

    public function __construct() {

        $this->dbObj = new DB();
        $this->helpObj = new Helper();
    }

    public function showProduct() {
        //for showing products and invoice data in table

        $query = 'SELECT tbl_invoice.*,tbl_product.*,tbl_type.typename,tbl_group.groupname'
                . ' FROM tbl_invoice,tbl_product,tbl_type,tbl_group WHERE'
                . ' tbl_invoice.product_id = tbl_product.product_id '
                . 'AND tbl_product.product_type = tbl_type.typeid '
                . 'AND tbl_product.product_group = tbl_group.groupid '
                . 'ORDER by tbl_invoice.date DESC';
        $st = $this->dbObj->select($query);

        $val = '';
        if ($st) {
            while ($r = $st->fetch_assoc()) {
                $val .= '<tr style="text-align:center;">'
                        . '<td>' . $r['product_id'] . '</td>'
                        . '<td>' . $r['product_name'] . '</td>'
                        . '<td>' . $r['typename'] . '</td>'
                        . '<td>' . $r['groupname'] . '</td>'
                        . '<td>' . $r['size_h'] . '</td>'
                        . '<td>' . $r['size_w'] . '</td>'
                        . '<td>' . $r['quantity'] . '</td>'
                        . '<td>' . $r['carton'] . '</td>'
                        . '<td>' . $r['piece'] . '</td>'
                        . '<td>' . $r['purchase'] . '</td>'
                        . '<td>' . $r['subtotal'] . '</td>'
                        . '<td>' . $r['total'] . '</td>'
                        . '<td>' . $r['status'] . '</td>'
                        . '</tr>'
                ;
            }
            return $val;
        } else {
            return false;
        }
    }

    public function showProductByInvoiceId($invoice_no, $date, $supplier_id) {
        //this function is for appending table row with form  
        //appending form in the row
        $query = "select * from tbl_invoice order by serial desc";

        $stmt = $this->dbObj->link->query($query);
        $value = '';
        if ($stmt) {
            while ($r = $stmt->fetch_assoc()) {
                $value .= '<tr>'
                        . '<td>' . $r['quantity'] . '</td>'
                        . '<td>' . $r['carton'] . '</td>'
                        . '<td>' . $r['piece'] . '</td>'
                        . '<td>' . $r['purchase'] . '</td>'
                        . '<td>' . $r['subtotal'] . '</td>'
                        . '<td>' . $r['total'] . '</td>'
                        . '<td>' . $r['status'] . '</td>'
                        . '<td>' . $r['status'] . '</td>'
                        . '<td>' . $r['status'] . '</td>'
                        . '<td>' . $r['status'] . '</td>'
                        . '<td>' . $r['status'] . '</td>'
                        . '<td>' . $r['status'] . '</td>'
                        . '<td>' . $r['status'] . '</td>'
                        . '</tr>';
            }
        } else {
            return false;
        }
        echo $value;
    }

}
