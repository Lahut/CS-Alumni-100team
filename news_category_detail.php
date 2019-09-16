<?php 
include "header.php";
if(isset($_POST["btnSave"])){
    $txtSubject = $_POST["txtSubject"];
    $sql = "";
    if(empty($_GET["ref"])){
        $genID = GenerateNextID("news_category","CategoryCode",5,"C");
        $sql = "insert into news_category (CategoryCode,CategoryName,AllowAlumni,Active,CreatedOn,CreatedBy) values(
                '$genID'
                ,'".$_POST["txtSubject"]."'
                ,".(isset($_POST["chkAlumni"]) ? 1 : 0)."
                ,".(isset($_POST["chkActive"]) ? 1 : 0)."
                ,NOW()
                ,'".UserService::UserCode()."'
            );
        ";
    }else{
        $sql = "update news_category set
                CategoryName = '$txtSubject'
                ,AllowAlumni = ".(isset($_POST["chkAlumni"]) ? 1 : 0)."
                ,Active = ".(isset($_POST["chkActive"]) ? 1 : 0)."
                ,UpdatedOn = NOW()
                ,UpdatedBy = '".UserService::UserCode()."'
                where CategoryCode = '".$_GET["ref"]."'
        ";
    }
    ExecuteSQL($sql);
    Alert("บันทึกข้อมูลเรียบร้อยแล้ว !");
    Redirect("news_category.php");
}
if(!empty($_GET["ref"]))
{
    $sql = "select * from news_category where CategoryCode = '".$_GET["ref"]."'";
    $data = SelectRow($sql);
}
?>
<div class="container">
    <h5><b>Mnage Category</b></h5>
    <hr />
    <form method="post" id="form-data" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-sm-12">
                        <label>Category Name</label>
                        <input type="text" name="txtSubject" required id="txtSubject" value="<?php echo $data["CategoryName"] ?>" class="form-control input-sm require" />
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-sm-6">
                        <b>Allow Alumni</b>
                        <div>
                            <input type="checkbox" name="chkAlumni" <?php echo $data["AllowAlumni"] == "1" ? "checked" : "" ?> value="" />
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <b>Active / Inactive</b>
                        <div>
                            <input type="checkbox" name="chkActive" <?php echo $data["Active"] == "1" ? "checked" : "" ?> value="" />
                        </div>
                    </div>
                </div>
                <hr />
                <div>
                    <button type="submit" name="btnSave" class="btn btn-primary">
                        <i class="fa fa-save"></i>Save                   
                    </button>
                    <a href="news_category.php" class="btn btn-secondary"><i class="fa fa-remove"></i>Cancel                    </a>
                </div>
            </div>
        </div>
    </form>
</div>
<?php 
include "footer.php";
?>