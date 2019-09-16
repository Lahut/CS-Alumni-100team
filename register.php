<?php 
require __DIR__."/config/database.php";
require __DIR__."/services/util_service.php";

if(isset($_POST["btnSignUp"])) // ถ้ามีการคลิกปุ่ม Save จะเข้าทำงานที่ if ด้านล่าง
{
    
    if($_POST["txtPassword"] != $_POST["txtConfirmPassword"]){
        Alert("บันทึกล้มเหลว รหัสผ่านและการยืนยันรหัสผ่านไม่ตรงกัน"); 
    }else{
    
        //เช็คว่า key ที่ใช้ในการ insert ลงตาราง มีแล้วหรือยัง
        if(isRepeatKey("user","Email",$_POST["txtEmail"])) // --> ถ้ามีแล้วให้แจ่้งเตือน
        {
            Alert("บันทึกล้มเหลว อีเมล์ ".$_POST["txtEmail"]." มีอยู่ในระบบแล้ว");    
        }
        else // --> ถ้ายังไม่มีจะทำโค้ดต่อไปนี้
        {
            $userCode = GenerateNextID("user","UserCode",10,"ALN"); // ฟังก์ชั่น generate auto ID
            // เตรียม SQL ที่ใช้ในการ insert ข้อมูล
            $sql = "insert into user (UserCode,FirstName,LastName,NickName,Password,Email,PublicInfo,Generation,Active,Type,CreatedBy,CreatedOn) values(";
            $sql .= "'$userCode'";
            $sql .= ",'".$_POST["txtFirstName"]."'";
            $sql .= ",'".$_POST["txtLastName"]."'";
            $sql .= ",'".$_POST["txtNickName"]."'";
            $sql .= ",'".GeneratePassword($_POST["txtPassword"])."'";
            $sql .= ",'".$_POST["txtEmail"]."'";
            $sql .= ",'".$_POST["txtPublicInfo"]."'";
            $sql .= ",'".$_POST["txtGeneration"]."'";
            $sql .= ",1";
            $sql .= ",'ALUMNI'";
            $sql .= ",'$userCode',NOW());";
        
            ExecuteSQL($sql); // Execute SQL ที่ใช้ในการ insert ข้อมูล
            Alert("บันทึกข้อมูลเรียบร้อยแล้ว ! สามารถใช้อีเมล์ \"".$_POST["txtEmail"]."\" ในการเข้าสู่ระบบได้ทันที");
            Redirect("login.php");
        }
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
                            <h5 class="text-center mt-3 mb-4">Sign up as Alumni</h5>
                            <hr />
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Firstname</label>
                                    <input type="text" class="form-control" required name="txtFirstName"  />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Lastname</label>
                                    <input type="text" class="form-control" required name="txtLastName"  />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Nickname</label>
                                    <input type="text" class="form-control" required name="txtNickName"  />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>รุ่นที่จบ</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                KU
                                            </div>
                                        </div>
                                        <input type="number" class="form-control" required name="txtGeneration"  />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label>Public Info</label>
                                    <textarea rows="5" class="form-control" name="txtPublicInfo"></textarea>
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Email</label>
                                    <input type="email" class="form-control" required name="txtEmail"  />
                                </div>
                                <div class="col-md-6 mb-3"></div>
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
                                SIGN UP
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
