<?php

include_once 'classes/DB.php';

class Helper {

    public $dbObj;

    function __construct() {
        $this->dbObj = new DB();
    }

    public function validation($data) {
        $data = trim($data);
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        return $data;
    }

    public function realEscape($data) {
        $data = mysqli_real_escape_string($this->dbObj->link, $data);
        return $data;
    }

    public function validAndEscape($data) {
        $data = $this->validation($data);
        $data = $this->realEscape($data);
        return $data;
    }

    public function formatDate($date, $format = 'd-m-Y') {
        return date($format, strtotime($date));
    }

}

?>