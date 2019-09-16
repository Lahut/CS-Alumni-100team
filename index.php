<?php 
include "header.php";
if(isset($_POST["btnInactive"])){
    $userCode = $_POST["btnInactive"];
    $sql = "update user set Active = '0' where UserCode = '$userCode'";
    ExecuteSQL($sql);
    Alert("บันทึกข้อมูลเรียบร้อยแล้ว!");
}
?>

<div class="container">
    <h5><b>Alumni List</b></h5>
    <hr />
    <table class="table table-bordered table-striped table-hover">
        <tr>
            <th class="text-center" style="width:40px;">รหัสศิษย์เก่า</th>
            <th style="width:100px;">รุ่นที่จบ</th>
            <th>Fullname</th>
            <th>Nickname</th>
            <th>Email</th>
            <th style="width:40px;">Manage</th>
        </tr>
        <?php 
        
        $sql = "select * from user where Type = 'Alumni' and Active = 1 order by UserCode";
        $datas = SelectRows($sql);
        foreach ($datas as $data)
        {?>
        <tr>
            <td class="text-center"><?php echo $data["UserCode"] ?></td>
            <td>KU<?php echo $data["Generation"] ?></td>
            <td><?php echo $data["FirstName"] ?> <?php echo $data["LastName"] ?></td>
            <td><?php echo $data["NickName"] ?></td>
            <td><?php echo $data["Email"] ?></td>
            <td>
                <form method="post"><button type="submit" name="btnInactive" onclick="return confirm('Are you want to do this ?');" value="<?php echo $data["UserCode"] ?>" class="btn btn-danger btn-sm">Inactive</button></form>
            </td>
        </tr>
        <?php }
        
        ?>
    </table>
</div>

<?php 
include "footer.php";
?>