<?php
require_once("include/db_connect.php");
require_once("include/inc_func.php");
// $content = trim(file_get_contents("php://input"));
// $decodedData = json_decode($content, true);
//  var_dump($decodedData);
// var_dump($_FILES);
// var_dump($_POST);

$resultData = array();
$resultData['msg'] = "";
$resultData['data'] = null;
$resultData['isSuccess'] = false;

$filpath = "";

$a_name="";
if(isset($_POST['a_name'])){
    $a_name=myStripslashes( $_POST['a_name']);
}
$a_job="";
if(isset($_POST['a_job'])){
    $a_job=myStripslashes( $_POST['a_job']);
}
$a_name_en="";
if(isset($_POST['a_name_en'])){
    $a_name_en=myStripslashes( $_POST['a_name_en']);
}
$a_job_en="";
if(isset($_POST['a_job_en'])){
    $a_job_en=myStripslashes( $_POST['a_job_en']);
}
$id=0;
if(isset($_POST['id'])){
    $id=intval($_POST['id']);
}
$isenable=0;
if(isset($_POST['isenable'])){
    $isenable=intval($_POST['isenable']);
}

if (count($_FILES) > 0) {
    //檔案
    date_default_timezone_set("Asia/Taipei");
    $myDate = date("Ymd");
    $myTime = date("H:i:s");

    //如果目錄沒有則建立
    $path2       = substr($myDate, 0, 4) . "/" . substr($myDate, 4, 2);
    $storeFolder = "upload" . "/" . $path2 . "/";

    @mkdir($storeFolder, 0777, true);

    $extension = pathinfo($_FILES['fileupload']['name'], PATHINFO_EXTENSION);

    $new_name = time() . '.' . $extension;

    move_uploaded_file($_FILES['fileupload']['tmp_name'], $storeFolder . $new_name);
    $filpath = $storeFolder . $new_name;
} else if (strval($_POST['dowhat']) != "delete") {

    $filpath = $_POST['name'];
}


if (strval($_POST['dowhat'])== 'query') {
    $sql = "select * from about_position_list where isenable=1";
    $result = $pdo->query($sql);
    $temparr = array();
    while ($stmt = $result->fetch(PDO::FETCH_ASSOC)) {
        //select column by key and use
        array_push($temparr, ['photo'=>$stmt['photo'],'a_name'=>$stmt['a_name'],'a_job'=>$stmt['a_job'] ,'a_name_en'=>$stmt['a_name_en'],'a_job_en'=>$stmt['a_job_en']]);
    }
    $resultData['msg'] = "資料搜尋成功";
    $resultData['data'] = $temparr;
    $resultData['isSuccess'] = true;
   
}
if (strval($_POST['dowhat']) == "add") {

// echo '$removaldate=<br>'.date('Y-m-d',strtotime( $removaldate.' 15:00:02'));
// var_dump($date_input);

    $sql = "INSERT INTO about_position_list (photo,a_name,a_job,a_name_en,a_job_en,isenable,createdt) VALUES (:photo,:a_name,:a_job,:a_name_en,:a_job_en,:isenable,current_timestamp())";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'photo' => $filpath,//$_POST['category'],
        'a_name'=>$a_name,
        'a_job'=>$a_job,
        'a_name_en'=>$a_name_en,
        'a_job_en'=>$a_job_en,
       
        'isenable' =>$isenable// intval($_POST['enable'])
    ]);
    $lastInsertId = $pdo->lastInsertId("rowid");



    // echo "新記錄插入成功，ID: " . $pdo->lastInsertId();
    $resultData['msg'] = "新記錄插入成功";
    $resultData['isSuccess'] = true;
}
if (strval($_POST['dowhat']) == "edit") {

  
    $sql = "UPDATE about_position_list SET photo=:photo,a_name=:a_name,a_job=:a_job,a_name_en=:a_name_en,a_job_en=:a_job_en,isenable=:isenable,modifydt=current_timestamp() WHERE rowid = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(
        [
            'photo' => $filpath,
            'a_name'=>$a_name,
            'a_job'=>$a_job,
            'a_name_en'=>$a_name_en,
            'a_job_en'=>$a_job_en,
            'isenable' => $isenable,
            'id' => $id,
            
        ]
    );

   

    // echo "記錄更新成功";
    $resultData['msg'] = "記錄更新成功";
    $resultData['isSuccess'] = true;
}
if (strval($_POST['dowhat']) == "delete") {
    
    $name = "";
    $sql = "select photo from  about_position_list where rowid = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => intval($_POST['id'])]);
    if ($stmt->rowCount() > 0) {
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            //select column by key and use
            $name = $result['photo'];
        }
       
        if (!empty($name) && file_exists($name)) {
              
            if (unlink($name)) {
          
                $sql = "DELETE FROM  about_position_list  WHERE rowid = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(['id' => intval($_POST['id'])]);
                

                // echo "記錄更新成功";
                $resultData['msg'] = "刪除成功";
                $resultData['isSuccess'] = true;
            } else {
                $resultData['msg'] = "刪除失敗";
                $resultData['isSuccess'] = false;
            }
        }else{
            
            //沒有檔案可刪除
            $sql = "DELETE FROM  about_position_list  WHERE rowid = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id' => intval($_POST['id'])]);

          

            // echo "記錄更新成功";
            $resultData['msg'] = "刪除成功";
            $resultData['isSuccess'] = true;
        }
    } else {

        $resultData['msg'] = "刪除失敗";
        $resultData['isSuccess'] = false;
    }
}
echo json_encode($resultData, JSON_UNESCAPED_UNICODE);
