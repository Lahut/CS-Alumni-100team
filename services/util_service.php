<?php session_start();
function GetConnection()
{

    // Create connection
    $conn = new mysqli(DBConnection::$host, DBConnection::$username, DBConnection::$password, DBConnection::$database_name);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    
    mysqli_query($conn,"SET character_set_results=utf8");
    mysqli_query($conn,"SET character_set_client=utf8");
    mysqli_query($conn,"SET character_set_connection=utf8");
    
    return $conn;
}

function SelectRow($sql)
{
    $connextion = GetConnection();
	$result = mysqli_query($connextion,$sql);
    if (!$result){
        die("Select row failed : " . $connextion->error);
    }
    return $result->num_rows == 0 ? false : $result->fetch_assoc();
}

function SelectRows($sql)
{
	$connextion = GetConnection();
	$result = mysqli_query($connextion,$sql);
    return $result;
}

function ExecuteSQL($sql)
{
	$connextion = GetConnection();
	$result = mysqli_query($connextion,$sql);
    if (!$result){
        die("Execute SQL failed : " . $connextion->error);
    }
}

function GeneratePassword($input)
{
    $password = md5($input);
    $cost = 10;
    $salt = strtr(base64_encode(random_bytes(16)), '+', '.');
    $salt = sprintf("$2a$%02d$", $cost) . $salt;
    $hash = crypt($password, $salt);
    return $hash;
}

function GenerateNextID($table,$key,$length,$prefix)
{
    $prefixLength = strlen($prefix);
    $suffixLength = intval($length) - $prefixLength;
    $datas = SelectRow("select $key from `$table` where $key like '$prefix%'  order by $key desc limit 1");
    if(!$datas){
        return $prefix.str_pad("1",$suffixLength,"0",STR_PAD_LEFT);
    }
    $next = intval(str_replace($prefix,"",$datas[$key])) + 1;
    return $prefix.str_pad(strval($next),$suffixLength,"0",STR_PAD_LEFT);
}


function isRepeatKey($table,$column,$value)
{
    $sql = "select $column from $table where $column = '$value'";
	if(SelectRow($sql) == false){
        return false;
    }
    return true;
}

function Alert($msg)
{
    $srt = new GenerateScript();
    echo $srt->getScript("alert('$msg');");
}

function Redirect($url)
{
    $srt = new GenerateScript();
    echo $srt->getScript("location.href = '$url';");
}

class GenerateScript
{
    public static function getScript($script) {
        $header = "<script>";
        $foooter = "</script>";
        return $header.$script.$foooter;
    }
}

// === Upload File ===
function UploadFile($file,$path,$FileID = "")
{
    $guid = empty($FileID) ? GetGUID() : $FileID;
    $target_root = $_SERVER["DOCUMENT_ROOT"];
    $target_dir = $path;
    $target_file = $target_dir . basename($file["name"]);
    $target_file_type = pathinfo($target_file,PATHINFO_EXTENSION);
    $target_file_name = $guid .".".$target_file_type;
    $target_file_save = $target_root.$target_dir.$target_file_name;
    if (!file_exists($target_root.$target_dir)) {
        mkdir($target_root.$target_dir, 0777, true);
    }
    if (move_uploaded_file($file["tmp_name"], $target_file_save)) {
        return $target_file_name;
    } else {
        return false;
    }
}
function GetGUID(){
    if (function_exists('com_create_guid')){
        return com_create_guid();
    }else{
        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);// "-"
        $uuid =  substr($charid, 0, 8).$hyphen
                .substr($charid, 8, 4).$hyphen
                .substr($charid,12, 4).$hyphen
                .substr($charid,16, 4).$hyphen
                .substr($charid,20,12);
        return $uuid;
    }
}

class UserService
{
    public static function UserCode()
    {
        return $_SESSION["USER_SESSION_USER_CODE"];
    }
    public static function UserFullName()
    {
        return $_SESSION["USER_SESSION_USER_FULLNAME"];
    }
    public static function UserType()
    {
    	return $_SESSION["USER_SESSION_USER_TYPE"];
    }
    public static function IsMatchingPassword($input,$hash)
    {
        $decrypt = crypt(md5($input), $hash);
        return $hash == $decrypt;
    }
    public static function _CheckPassword($UserCode,$password)
    {
        $result = SelectRow("select Password from user where UserCode = '".$UserCode."'");
        if($result !== false && self::IsMatchingPassword($password,$result["Password"])){
            return true;
        }
        return false;
    }
    public static function _UserLogin($email,$password)
    {
        $result = SelectRow("select * from user where Active = 1 and Email = '".$email."'");
        if($result !== false){
            if(empty($result["Password"]) && $result["Type"] == "OFFICER"){
                Redirect("enter_password.php?ref=".$result["Email"]);
            }else{
                if(self::IsMatchingPassword($password,$result["Password"])){
                    $_SESSION["USER_SESSION_USER_CODE"] = $result["UserCode"];
                    $_SESSION["USER_SESSION_USER_FULLNAME"] = $result["FirstName"]." ".$result["LastName"];
                    $_SESSION["USER_SESSION_USER_TYPE"] = $result["Type"];
                
                    if(UserService::_IsAdmin()){
                        Redirect("index.php");
                    }else{
                        Redirect("home.php");
                    }
                    return;
                }
            }
        }
        Alert('sign in failed. Please check your username or password');
    }
    public static function _IsLoggedIn(){
        return !empty($_SESSION["USER_SESSION_USER_CODE"]);
    }
    public static function _IsAlumni(){
        return $_SESSION["USER_SESSION_USER_TYPE"] == "ALUMNI";
    }
    public static function _IsOfficer(){
        return $_SESSION["USER_SESSION_USER_TYPE"] == "OFFICER";
    }
    public static function _IsAdmin(){
        return $_SESSION["USER_SESSION_USER_TYPE"] == "ADMIN";
    }
}
?>