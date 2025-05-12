<?php 

$CKEcallback = $_POST['ckCsrfToken'];
$resultData = array();
$resultData["uploaded"]=true;

if (count($_FILES) > 0) {
    // echo 'count($_FILES) > 0<br>';
    //檔案
    date_default_timezone_set("Asia/Taipei");
    $myDate = date("Ymd");
    $myTime = date("H:i:s");

    //如果目錄沒有則建立
    $path2       = substr($myDate, 0, 4) . "/" . substr($myDate, 4, 2);
    $storeFolder = "./upload" . "/" . $path2 . "/";

    @mkdir($storeFolder, 0777, true);
    $sort=1;
    foreach ($_FILES as $file) {
    
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);

        $new_name = time() . '.' . $extension;

        move_uploaded_file($file['tmp_name'], $storeFolder . $new_name);
        $filepath = $storeFolder . $new_name;
        $resultData["url"]=$filepath;
    }
}
// echo '<script type="text/javascript">window.parent.CKEDITOR.tools.callFunction("'.$CKEcallback.'", "'.$filepath.'","'.'圖片上傳成功'.'");</script>';
echo json_encode($resultData, JSON_UNESCAPED_UNICODE);

?>