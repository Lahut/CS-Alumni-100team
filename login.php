<?php 
require __DIR__."/config/database.php";
require __DIR__."/services/util_service.php";
if(isset($_POST["btnSignIn"]))
{
    UserService::_UserLogin($_POST["txtLogin_Email"],$_POST["txtLogin_Password"]);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CS-Alumni</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/custom.css" rel="stylesheet">
</head>

<body id="page-top">

    <div class="login-body">
        <div class="login-container">
            <div class="login-panel">
                <div class="container">
                    <div class="row">
                    <div class="col-sm-3 col-lg-4"></div>
                    <div class="col-sm-6 col-lg-4">
                        <form method="post" class="login-dialog">
                            <h5 class="text-center mt-3 mb-4">CS-Alumni</h5>
                            <div class="mb-3">
                                <input type="email" placeholder="Email.." class="form-control" name="txtLogin_Email" value="" />
                            </div>
                            <div class="mb-3">
                                <input type="password" placeholder="Password.." class="form-control" name="txtLogin_Password" value="" />
                            </div>
                            <button name="btnSignIn" class="btn btn-primary btn-block" type="submit">
                                SIGN IN
                            </button>
                            <hr />
                            <div class="text-right">
                                <a href="register.php">Sign up now !</a>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
