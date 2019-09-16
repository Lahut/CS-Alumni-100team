<?php 
require __DIR__."/config/database.php";
require __DIR__."/services/util_service.php";

if(isset($_POST["btnSignUp"])) // ถ้ามีการคลิกปุ่ม Save จะเข้าทำงานที่ if ด้านล่าง
{
    
    if($_POST["txtPassword"] != $_POST["txtConfirmPassword"]){
        Alert("บันทึกล้มเหลว รหัสผ่านและการยืนยันรหัสผ่านไม่ตรงกัน"); 
    }else{
    
        $sql = "update user set Password = '".GeneratePassword($_POST["txtConfirmPassword"])."' where Email='".$_GET["ref"]."'";
        ExecuteSQL($sql); // Execute SQL ที่ใช้ในการ update ข้อมูล
        UserService::_UserLogin($_GET["ref"],$_POST["txtConfirmPassword"]);
    }
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
                    <div class="col-sm-1 col-lg-2"></div>
                    <div class="col-sm-10 col-lg-8">
                        <form method="post" class="login-dialog">
                            <h5 class="text-center mt-3 mb-4">Setting password (For first time sing in)</h5>
                            <hr />
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Password</label>
                                    <input type="password" class="form-control" required name="txtPassword"  />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Re-type Password</label>
                                    <input type="password" class="form-control" required name="txtConfirmPassword"  />
                                </div>
                            </div>
                            <button name="btnSignUp" class="btn btn-primary btn-block" type="submit">
                                Submit
                            </button>
                             <hr />
                            <div class="text-right">
                                <a href="login.php">Sign in</a>
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
