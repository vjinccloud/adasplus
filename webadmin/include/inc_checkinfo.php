<?php 
//设置当前目录下session子文件夹为session保存路径。
$sessSavePath = dirname(__FILE__).'/../sessions/';
chmod($sessSavePath, 0755);
//如果新路径可读可写（可通过FTP上变更文件夹属性为777实现），则让该路径生效。
// if(is_writeable($sessSavePath) && is_readable($sessSavePath) )
// {
   
//    session_save_path($sessSavePath);
// }else{
//    echo $sessSavePath." 指定session路径不可读写，请修改权限";
// }
if(!isset($_SESSION)){
    session_start();
}
require_once("db_connect.php"); 

Header('Cache-Control: no-cache');
Header('Pragma: no-cache');
date_default_timezone_set("Asia/Taipei");
$myDate = date("Ymd");
$myTime = date("H:i:s");

//如果目錄沒有則建立
$path2       = substr($myDate, 0, 4) . "/" . substr($myDate, 4, 2);
$storeFolder = "upload" . "/" . $path2 . "/";
$oldmask     = umask(0);
// @mkdir($storeFolder, 0777, true);
// umask($oldmask);
// chmod($storeFolder, 0777);



if(  $_SESSION['userdata']==null){
    // echo "!= true ".$_SESSION['Login_success'];
   header("Location:index.php");
}
// $tempurl=explode("/", $_SERVER['REQUEST_URI']);
// $myurl=trim( $tempurl[count($tempurl)-1]);
// // echo $myurl;
// $sql=" select rowid from menu_list where menuurl =:menuurl limit 1";
// $result = $pdo->prepare($sql);
// $result->execute(['menuurl' => $myurl]);
// $menuid=0;
// while ($stmt = $result->fetch(PDO::FETCH_ASSOC)) {
//     // echo "<br>";
//     // echo intval($stmt["rowid"]);
//     $menuid=intval($stmt["rowid"]);
// }
// $sql=" select edit from role_permissions where roleid=:roleid and menuid=:menuid ";
// $result = $pdo->prepare($sql);
// $result->execute(['roleid' => $_SESSION['userdata']['roleid'],'menuid'=>$menuid]);
// while ($stmt = $result->fetch(PDO::FETCH_ASSOC)) {
//     // echo "<br>";
//     // echo intval($stmt["edit"]);
//     $pedit=intval($stmt["edit"]);
// }
$pedit=1;
?>