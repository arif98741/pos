<?php include 'lib/header.php'; ?>

<?php

Session::destroy();
header("location: login.php");
?>


<?php include 'lib/footer.php'; ?>