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
    <a href="news_category_detail.php" class="float-right">+ Add new category</a>
    <h5><b>News Category List</b></h5>
    <hr />
    <table class="table table-bordered table-striped table-hover">
        <tr>
            <th style="width: 50px;">ID</th>
            <th>Category Name</th>
            <th style="width: 150px;" class="text-center">Allow Alumni</th>
            <th style="width: 120px;" class="text-center">Active</th>
            <th style="width: 150px;" class="text-center">Manage</th>
        </tr>
        <?php
        $sql = "select * from news_category order by CategoryCode";
        $datas = SelectRows($sql);
        while($data = $datas->fetch_array()){
        ?>
        <tr data-sortable-row-key="<?php echo $data["CategoryCode"] ?>">
            <td><?php echo $data["CategoryCode"] ?></td>
            <td><?php echo $data["CategoryName"] ?>
                        </td>
            <td class="text-center"><?php echo $data["AllowAlumni"] == 1 ? "Allow" : "Not allow" ?>
                        </td>
            <td class="text-center"><?php echo $data["Active"] == 1 ? "Active" : "Inactive" ?>
                        </td>
            <td class="text-center">
                <a class="btn btn-warning btn-sm"  href="news_category_detail.php?ref=<?php echo $data["CategoryCode"] ?>">Edit</a>
                <form method="post" style="display: inline">
                    <button type="submit" class="btn btn-danger btn-sm" 
                                    onclick="return confirm('ต้องการลบรายการนี้หรือไม่ ?');"
                                    value="<?php echo $data["CategoryCode"] ?>" name="btnDeleteRow">
                        Remove
                    </button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>
<?php 
include "footer.php";
?>