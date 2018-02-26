<?php
include 'classes/Session.php';
include_once 'classes/Login.php';
Session::checkLogin();
$log = new Login();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Point Of Sale Management Service</title>
        <!--bootstrap css-->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <!--font awesome css-->
        <link href="assets/css/font-awesome.min.css" rel="stylesheet">
        <!--developer css-->
        <link href="assets/css/login.css" rel="stylesheet">

    </head>
    <body>

        <div class="wrapper">
            <div class="content_section"> 
                <div class="container">
                    <p>
                        Username: admin
                    </p>
                    <p>
                        Password: admin
                    </p>
                    <div class="panel">


                        <div class="login_form" style="max-width: 500px;">

                            <!--login for admin and user-->
                            <?php
                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                $status = $log->login($_POST);
                            }
                            ?>

                            <form class="form-group" action="" method="POST">
                                <div class="form-heading"> 
                                    <h3><i class="fa fa-user-secret"></i>&nbsp;Login Panel</h3>
                                </div>
                                <div class="panel-body">
                                    <input name="username" type="text" class="form-control" id="" placeholder="Enter Username"><br/>
                                    <input name="password" type="password" class="form-control" id="" placeholder="Enter Password"><br/>
                                    <br/>
                                    <input class="form-control btn btn-success login_btn" type="submit" value="Login">
                                </div>
                                <div class="panel-body" id="login_message">
                                    <?php
                                    if (isset($status)) {
                                        echo $status;
                                    }
                                    ?>
                                </div>
                            </form> <!--login form end-->

                        </div>

                    </div>


                </div>

            </div>
        </div>
    </body>
</html>