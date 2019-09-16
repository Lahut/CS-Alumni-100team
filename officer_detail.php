<?php 
include "header.php";
if(isset($_POST["btnSubmit"])) // ถ้ามีการคลิกปุ่ม Save จะเข้าทำงานที่ if ด้านล่าง
{
    $userCode = $_GET["ref"];
    if(empty($userCode)){
        //เช็คว่า key ที่ใช้ในการ insert ลงตาราง มีแล้วหรือยัง
        if(isRepeatKey("user","Email",$_POST["txtEmail"])) // --> ถ้ามีแล้วให้แจ่้งเตือน
        {
            Alert("บันทึกล้มเหลว อีเมล์ ".$_POST["txtEmail"]." มีอยู่ในระบบแล้ว");    
        }
        else // --> ถ้ายังไม่มีจะทำโค้ดต่อไปนี้
        {
             $userCode = GenerateNextID("user","UserCode",10,"OFC"); // ฟังก์ชั่น generate auto ID
            // เตรียม SQL ที่ใช้ในการ insert ข้อมูล
            $sql = "insert into user (UserCode,FirstName,LastName,NickName,Password,PublicInfo,Generation,Email,Active,Type,CreatedBy,CreatedOn) values(";
            $sql .= "'$userCode'";
            $sql .= ",'".$_POST["txtFirstName"]."'";
            $sql .= ",'".$_POST["txtLastName"]."'";
            $sql .= ",''";
            $sql .= ",''";
            $sql .= ",''";
            $sql .= ",'0'";
            $sql .= ",'".$_POST["txtEmail"]."'";
            $sql .= ",1";
            $sql .= ",'OFFICER'";
            $sql .= ",'".UserService::UserCode()."',NOW());";
            
            ExecuteSQL($sql); // Execute SQL ที่ใช้ในการ insert ข้อมูล
            Alert("บันทึกข้อมูลเรียบร้อยแล้ว !");
            Redirect("officer.php");
        }
    }else{
         $sql = "update user set FirstName = '".$_POST["txtFirstName"]."',LastName = '".$_POST["txtLastName"]."' where UserCode='$userCode'";
         ExecuteSQL($sql); // Execute SQL ที่ใช้ในการ update ข้อมูล
         Alert("บันทึกข้อมูลเรียบร้อยแล้ว !");
         Redirect("officer.php");
    }
}

if(!empty($_GET["ref"])){
    $sql = "select * from user where Type = 'OFFICER' and Active = 1 and UserCode = '".$_GET["ref"]."'";
    $data = SelectRow($sql);
}
?>

<form method="post" class="container">
    <h5><b>Manage Officer</b></h5>
    <hr />
    <div class="row">
        <div class="col-md-6 mb-3">
            <label>Email</label>
            <input type="email" class="form-control" <?php echo empty($_GET["ref"]) ? "required" : "readonly" ?> name="txtEmail" value="<?php echo $data["Email"] ?>" />
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label>Firstname</label>
            <input type="text" class="form-control" required name="txtFirstName" value="<?php echo $data["FirstName"] ?>" />
        </div>
        <div class="col-md-6 mb-3">
            <label>Lastname</label>
            <input type="text" class="form-control" required name="txtLastName" value="<?php echo $data["LastName"] ?>" />
        </div>
       
    </div>
    <hr />
    <button name="btnSubmit" class="btn btn-primary" type="submit">
        Save
    </button>
    <a href="officer.php" class="btn btn-secondary">Cancel</a>
</form>

<?php 
include "footer.php";
?>