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
        <!--login for admin and user-->
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $status = $log->login($_POST);
        }
        ?>
        <div class="container" style="margin-top:40px">
            <div class="row">
                <div class="col-sm-6 col-md-4 col-md-offset-4">
                    <div class="panel panel-default">

                        <div class="panel-body">
                            <form role="form" action="" method="POST">
                                <fieldset>
                                    <div class="row">
                                        <div class="center-block">
                                            <img class="profile-img" src="images/login-user.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <h3 style="text-align: center;">Admin Login Panel</h3>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-10  col-md-offset-1 ">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-user"></i>
                                                    </span> 
                                                    <input class="form-control" placeholder="Username" name="username" type="text" autofocus>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-lock"></i>
                                                    </span>
                                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-primary btn-block" id="sign_btn" value="Sign in">
                                            </div>
                                            <div id="login_message">
                                                <?php
                                                if (isset($status)) {
                                                    echo $status;
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                        <!-- <div class="panel-footer ">
                              Don't have an account! <a href="#" onClick=""> Sign Up Here </a>
                               </div>-->
                    </div>
                </div>
            </div>
        </div>
        <script src="assets/js/jquery.min.js"></script>
        <script>
            $(document).ready(function () {
                setTimeout(function () {
                    $('#message').slideUp(500);
                }, 1000);
            });
        </script>
    </body>
</html>