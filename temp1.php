<?php

$con = new mysqli('localhost', 'root', '', 'test');
if ($con) {
    $st = $con->query("select * from tbl_unique order by seria desc");
    echo "<ul>";
    $i = 0;
    while ($r = $st->fetch_assoc()) {
        $i++;
        echo "<li>" . $r['unique_id'] . "</li>";
    }

    echo "</ul>";
    echo "Size is " . $i;
} else {
    echo mysqli_errno($con);
}


