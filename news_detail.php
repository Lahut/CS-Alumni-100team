<?php 
include "header.php";
<form method="post" enctype="multipart/form-data" class="container">
    <h5><b>Manage News</b></h5>
    <hr />
    <div class="row">
    <br />
    <div class="row">
    <hr />
    <div>
        <button type="submit" name="btnSubmit" onclick="return confirm('ต้องการบันทึกหรือไม่');" class="btn btn-primary">
            <i class="fa fa-save"></i>Save
        </button>
        <a href="news.php" class="btn btn-secondary"><i class="fa fa-remove"></i>Cancel
    </div>
</form>
<?php 
include "footer.php";
?>