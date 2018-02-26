<?php include 'lib/header.php'; ?>

<?php

session_destroy();
header("location: login.php");
?>


<?php include 'lib/footer.php'; ?>