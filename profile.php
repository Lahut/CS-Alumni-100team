<?php 
include "header.php";


if(isset($_POST["btnEdit"])) // ถ้ามีการคลิกปุ่ม Save จะเข้าทำงานที่ if ด้านล่าง
{
    $userCode = UserService::UserCode();
    $sql = "update user set 
            FirstName = '".$_POST["txtFirstName"]."' 
            ,LastName = '".$_POST["txtLastName"]."' 
            ,NickName = '".$_POST["txtNickName"]."' 
            ,PublicInfo = '".$_POST["txtPublicInfo"]."' 
            ,Generation = '".$_POST["txtGeneration"]."' 
            where UserCode = '$userCode'";
    
    ExecuteSQL($sql);
    Alert("บันทึกข้อมูลเรียบร้อยแล้ว!");
}


if(isset($_POST["btnChangePassword"]))
{
    if($_POST["txtPassword"] != $_POST["txtConfirmPassword"]){
        Alert("บันทึกล้มเหลว รหัสผ่านและการยืนยันรหัสผ่านไม่ตรงกัน"); 
    }else{
        $userCode = UserService::UserCode();
        $sql = "update user set Password = '".GeneratePassword($_POST["txtPassword"])."' where UserCode = '$userCode'";
        ExecuteSQL($sql);
        Alert("บันทึกข้อมูลเรียบร้อยแล้ว! กรุณาเข้าสู่ระบบอีกครั้ง");
        Redirect("logout.php");
    }
}

$data = SelectRow("select * from user where UserCode = '".UserService::UserCode()."'");

?>


<div class="container">
    <div class="row">
        <div class="col-sm-1 col-lg-2"></div>
        <div class="col-sm-10 col-lg-8">

            <h5 class="text-primary">
            <b>KU<?php echo $data["Generation"] ?> :</b>
            <?php echo $data["FirstName"] ?> 
            <?php echo $data["LastName"] ?> 
            (<?php echo $data["NickName"] ?>)
            </h5>
            <hr />

            <form method="post" class="login-dialog">
                <h5 class="text-center mt-3 mb-4">Edit Your Profile</h5>
                <hr />
                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label>Firstname</label>
                        <input type="text" class="form-control" required name="txtFirstName" value="<?php echo $data["FirstName"] ?>" />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Lastname</label>
                        <input type="text" class="form-control" required name="txtLastName" value="<?php echo $data["LastName"] ?>" />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Nickname</label>
                        <input type="text" class="form-control" required name="txtNickName" value="<?php echo $data["NickName"] ?>"/>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>รุ่นที่จบ</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    KU
                                </div>
                            </div>
                            <input type="number" class="form-control" required name="txtGeneration" value="<?php echo $data["Generation"] ?>" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label>Public Info</label>
                        <textarea rows="5" class="form-control" name="txtPublicInfo"><?php echo $data["PublicInfo"] ?></textarea>
                    </div>
                </div>
                <button name="btnEdit" class="btn btn-primary btn-block" type="submit">
                    EDIT PROFILE
                </button>
            </form>

            <hr />

            <form method="post" class="login-dialog">
                <h5 class="text-center mt-3 mb-4">Change Password</h5>
                <hr />
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Email</label>
                        <input type="email" class="form-control" readonly name="txtEmail" value="<?php echo $data["Email"] ?>" />
                    </div>
                    <div class="col-md-6 mb-3"></div>
                    <div class="col-md-6 mb-3">
                        <label>Password</label>
                        <input type="password" class="form-control" required name="txtPassword" />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Re-type Password</label>
                        <input type="password" class="form-control" required name="txtConfirmPassword" />
                    </div>
                </div>
                <button name="btnChangePassword" class="btn btn-primary btn-block" type="submit">
                    Change Password
                </button>
            </form>
        </div>
    </div>
</div>
<?php 
include "footer.php";
?>

