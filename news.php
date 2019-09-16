<?php 
include "header.php";
if(isset($_POST["btnDeleteRow"])){
    $sql = "delete from news where NewsCode = '".$_POST["btnDeleteRow"]."'";
    ExecuteSQL($sql);
}
?>
<div class="container">
    <a href="news_detail.php" class="float-right">+ Add news</a>
    <h5><b>News List</b></h5>
    <hr />
    <table class="table table-bordered table-striped table-hover">
        <tr>
            <th>Subject</th>
            <th>Category</th>
            <th style="width: 50px;" class="text-center">Active</th>
            <th style="width: 150px;" class="text-center">Manage</th>
        </tr>
        <?php
        $sql = "select n.*,c.CategoryName from news n 
                    left join news_category c on c.CategoryCode = n.CategoryCode
                    where n.CreatedBy = '".UserService::UserCode()."' order by n.NewsCode";
        $datas = SelectRows($sql);
        while($data = $datas->fetch_array()){
        ?>
        <tr>
            <td><?php echo $data["Subject"] ?>
            <td><?php echo empty($data["CategoryName"]) ? "ไม่ได้ระบุหมวดหมู่" : $data["CategoryName"] ?></td>
            
                        </td>
            <td class="text-center sortable-hide-item"><?php echo $data["Active"] == 1 ? "Active" : "Inactive" ?>
                        </td>
            <td class="text-center sortable-hide-item">
                <a title="แก้ไขข้อมูล" href="news_detail.php?ref=<?php echo $data["NewsCode"] ?>" class="btn btn-warning btn-sm">Edit</a>
                <form method="post" style="display: inline">
                    <button type="submit" class="btn btn-danger btn-sm" 
                                    onclick="return confirm('ต้องการลบรายการนี้หรือไม่ ?');"
                                    value="<?php echo $data["NewsCode"] ?>" name="btnDeleteRow">
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