<?php

class DB {

    public $link;
    private $username = 'root';
    private $password = '';
    private $host = 'localhost';
    private $database = 'dts';

    function __construct() {
        $this->link = $this->connection();
    }

    public function connection() {
        $link = new mysqli($this->host, $this->username, $this->password, $this->database);
        if (!$link) {
            return die('Connection Failed');
        } else {
            return $link;
        }
    }

    public function select($query) {
        $stmt = $this->link->query($query) or die($this->link->error). " error at line number ".__LINE__;
        if ($stmt->num_rows > 0) {
            return $stmt;
        } else {
            return false;
        }
    }

    public function selectFetchAssoc($query) {
        $stmt = $this->link->query($query);
        if ($stmt->num_rows > 0) {
            return $stmt->fetch_assoc();
        } else {
            return false;
        }
    }

    public function selectFetchArray($query) {
        $stmt = $this->link->query($query);
        if ($stmt->num_rows > 0) {
            return $stmt->fetch_array();
        } else {
            return false;
        }
    }

    public function selectFetchObject($query) {
        $stmt = $this->link->query($query);
        if ($stmt->num_rows > 0) {
            return $stmt->fetch_object();
        } else {
            return false;
        }
    }

    public function insert($query) {
        $stmt = $this->link->query($query);
        if ($stmt) {
            return $stmt;
        } else {
            return false;
        }
    }

    public function update($query) {
        $stmt = $this->link->query($query);
        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($query) {
        $stmt = $this->link->query($query);
        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }

    public function rowCount($query) {
        $stmt = $this->link->query($query);
        if ($stmt->num_rows > 0) {
            return $stmt->num_rows;
        } else {
            return false;
        }
    }

    public function ExtraQuery($product_id, $parameter = '') {
        $query = "select * from tbl_product where product_id='$product_id' limit 1";
        $stmt = $this->link->query($query);
        if ($stmt->num_rows > 0) {
            $result = $stmt->fetch_assoc();
        } else {
            return "nothing";
        }
    }

    public function __destruct() {
        unset($this->link);
    }

}
