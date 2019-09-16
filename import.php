<?php 
include "header.php";
if(isset($_POST["btnUploadData"]) && isset($_POST["txtUpload0"])){
    $countRows = count($_POST["txtUpload0"]);
    $countSuccess = 0;
    $countFailed = 0;
    for ($i = 0; $i < $countRows; $i++)
    {
        
        if(isRepeatKey("user","Email",$_POST["txtUpload0"][$i]))
        {
            $countFailed++;
        }
        else
        {
            $userCode = GenerateNextID("user","UserCode",10,"ALN");
            $sql = "insert into user (UserCode,FirstName,LastName,NickName,Password,Email,PublicInfo,Generation,Active,Type,CreatedBy,CreatedOn) values(";
            $sql .= "'$userCode'";
            $sql .= ",'".$_POST["txtUpload2"][$i]."'";
            $sql .= ",'".$_POST["txtUpload3"][$i]."'";
            $sql .= ",'".$_POST["txtUpload4"][$i]."'";
            $sql .= ",'".GeneratePassword($_POST["txtUpload1"][$i])."'";
            $sql .= ",'".$_POST["txtUpload0"][$i]."'";
            $sql .= ",'".$_POST["txtUpload6"][$i]."'";
            $sql .= ",'".$_POST["txtUpload5"][$i]."'";
            $sql .= ",1";
            $sql .= ",'ALUMNI'";
            $sql .= ",'".UserService::UserCode()."',NOW());";
                
            $connextion = GetConnection();
            $result = mysqli_query($connextion,$sql);
            if (!$result){
                $countFailed++;
            }else{
                $countSuccess++;
            }
        }
    }
    Alert("Success = $countSuccess ,Failed = $countFailed");
}
?>

<div class="container">
    <h5><b>Import data by CSV file</b></h5>
    <hr />
    <form method="post" enctype="multipart/form-data">
        <b>Step 1 : Upload CSV</b>
        <div class="input-group mt-2" onclick="$(this).next().click()">
            <input type="text" class="form-control"><div class="input-group-append">
                <button type="button" class="btn btn-outline-primary">Browse...</button>
            </div>
        </div>
        <input style="display: none" type="file" name="fileUpload" value="" onchange="$(this).next().click()" />
        <input style="display: none" type="submit" name="btnUpload" value="" />
    </form>
    <form method="post">
        <hr />
        <b>Step 2 : Checking data</b>
        <table class="table table-bordered table-striped table-hover mt-2">
            <tr>
                <th class="text-center" style="width: 40px;">#</th>
                <th>Email
                <b class="text-danger">*</b>
                </th>
                <th>Password
                <b class="text-danger">*</b>
                </th>
                <th>FirstName
                <b class="text-danger">*</b>
                </th>
                <th>LastName
                <b class="text-danger">*</b>
                </th>
                <th>NickName
                <b class="text-danger">*</b>
                </th>
                <th>รุ่นที่จบ
                <b class="text-danger">*</b>
                </th>
                <th>Public Info</th>
            </tr>
            <?php 
            if(isset($_POST["btnUpload"])){
                $filename = $_FILES["fileUpload"]["name"];
                $ext=substr($filename,strrpos($filename,"."),(strlen($filename)-strrpos($filename,".")));
                
                //we check,file must be have csv extention
                if(strtolower($ext) == ".csv")
                {
                    $file = fopen($_FILES["fileUpload"]["tmp_name"], "r");
                    $rowIndex = 1;
                    while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
                    {
                        $isValid = true;
                        for ($i = 0; $i < 7; $i++)
                        {
                            if($i < 6 && trim($emapData[$i]) == ""){
                                $isValid = false;
                            }
                        }
                        
            ?>
            <tr class="<?php echo $isValid ? "text-success" : "text-danger" ?>">
                <td class="text-center"><?php echo $rowIndex++ ?></td>
                <?php
                        for ($i = 0; $i < 7; $i++)
                        {
                            $isValid = true;
                            if($i < 6 && trim($emapData[$i]) == ""){
                                $isValid = false;
                            }
                ?>
                <td>
                    <input name="txtUpload<?php echo $i ?>[]" type="<?php echo $i == 0 ? "email" : ($i == 5 ? "number" : "text") ?>" class="form-control" <?php echo $i < 6 ? "required" : "" ?> value="<?php echo $emapData[$i] ?>" />
                </td>
                <?php
                        }
                ?>
            </tr>
            <?php
                    }
                    fclose($file);
                }
                else {
                    Alert("Error: Please Upload only CSV File");
                }
            }
            ?>
        </table>

        <hr />
        <b>Step 3 : Confirm and Upload data</b>
        <button name="btnUploadData" class="btn btn-primary btn-block mt-2" type="submit">
            UPLOAD DATA
        </button>
    </form>
</div>

<?php 
include "footer.php";
?>