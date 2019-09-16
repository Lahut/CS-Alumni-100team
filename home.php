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
    <?php
    <div class="row">
        <div class="col-lg-4">
            <img src="<?php echo $data["Image"] ?>" alt="<?php echo $data["Subject"] ?>" style="width:100%" />
        </div>
        <div class="col-lg-8">
            <h5><b><?php echo $data["Subject"] ?></b></h5>
            <p  class="text-muted">
                <span>Posted On : <b><?php echo $data["CreatedOn"] ?></b></span>
                |
                <span>Posted By : <b><?php echo $data["FullName"] ?></b></span>
            </p>
            <?php echo str_replace("\n","<br>",$data["Description"]) ?>
        </div>
    </div>
    <br />
    <hr />
    <br />
    <?php } ?>
</div>

<?php 
include "footer.php";
?>