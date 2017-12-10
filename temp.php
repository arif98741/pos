<?php

date_default_timezone_set('Asia/Dhaka');
$uniqid = uniqid(date('dmYhis-') . rand(10, 50) . '-');
$con = new mysqli('localhost', 'root', '', 'test');
$get = $con->query('select *from tbl_unique order by seria desc');
if ($con) {
    $st = $con->query("insert into tbl_unique(unique_id) values('$uniqid')");
} else {
    echo mysqli_errno($con);
}
while ($get->fetch_assoc()) {
    echo "<pre>";
    print_r($get->fetch_assoc());
    echo "</pre>";
}



