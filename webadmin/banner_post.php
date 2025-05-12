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

$b_title="";
if(isset($_POST['title'])){
    $b_title=myStripslashes( $_POST['title']);
}
$b_title_en="";
if(isset($_POST['title_en'])){
    $b_title_en=myStripslashes($_POST['title_en']);
}
$b_subtitle="";
if(isset($_POST['subtitle'])){
    $b_subtitle=myStripslashes( $_POST['subtitle']);
}
$b_subtitle_en="";
if(isset($_POST['subtitle_en'])){
    $b_subtitle_en=myStripslashes($_POST['subtitle_en']);
}
$b_content="";
if(isset($_POST['content'])){
    $b_content=myStripslashes( $_POST['content']);
}
$b_content_en="";
if(isset($_POST['content_en'])){
    $b_content_en=myStripslashes($_POST['content_en']);
}

$b_sort = 0;
if (isset($_POST['sort'])) {
    $b_sort = intval($_POST['sort']);
}

$isenable = 0;
if (isset($_POST['enable'])) {
    $isenable = intval($_POST['enable']);
}
$rowid = 0;
if (isset($_POST['id'])) {
    $rowid = intval($_POST['id']);
}

$filpath = "";

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
} else if (strval($_POST['dowhat']) != "delete"){
    $filpath = $_POST['name'];
}

if (strval($_POST['dowhat']) == "query") {
    $sql="select * from banner_list where isenable=1 order by b_sort limit 3";
    $result = $pdo->query($sql);
    $i=0;
    $tempdatas=[];
    while ($stmt = $result->fetch(PDO::FETCH_ASSOC)) {
        array_push( $tempdatas,
        [['banner'=>$stmt['banner']],
        ['en'=>['home_banner_text_t_'.$i=>$stmt['b_title_en'],'home_banner_text_st_'.$i=>$stmt['b_subtitle_en'],'home_banner_text_'.$i=>$stmt['b_content_en']]],
        ["zh"=>['home_banner_text_t_'.$i=>$stmt['b_title'],'home_banner_text_st_'.$i=>$stmt['b_subtitle'],'home_banner_text_'.$i=>$stmt['b_content']]]]);
        $i++;

    }
    $resultData['data'] =$tempdatas;
    $resultData['msg'] = "搜尋成功";
    $resultData['isSuccess'] = true;
}

if (strval($_POST['dowhat']) == "add") {



    $sql = "INSERT INTO banner_list (banner,b_title,b_title_en,b_subtitle,b_subtitle_en,b_content,b_content_en,b_sort,isenable,createdt) ";
    $sql .=" VALUES (:banner,:b_title,:b_title_en,:b_subtitle,:b_subtitle_en,:b_content,:b_content_en,:b_sort,:isenable,current_timestamp())";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['banner'=>$filpath,'b_title'=>$b_title,'b_title_en'=>$b_title_en,'b_subtitle'=>$b_subtitle,'b_subtitle_en'=>$b_subtitle_en,'b_content'=>$b_content,
                    'b_content_en'=>$b_content_en,'b_sort'=>$b_sort,'isenable'=>$isenable]);

    // echo "新記錄插入成功，ID: " . $pdo->lastInsertId();
    $resultData['msg'] = "新記錄插入成功";
    $resultData['isSuccess'] = true;
}
if (strval($_POST['dowhat']) == "edit") {


    $sql = "UPDATE banner_list SET  banner=:banner,b_title=:b_title,b_title_en=:b_title_en,b_subtitle=:b_subtitle,b_subtitle_en=:b_subtitle_en,b_content=:b_content ";
    $sql .=" ,b_content_en=:b_content_en,b_sort=:b_sort,isenable=:isenable,modifydt=current_timestamp() WHERE rowid = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['banner'=>$filpath,'b_title'=>$b_title,'b_title_en'=>$b_title_en,'b_subtitle'=>$b_subtitle,'b_subtitle_en'=>$b_subtitle_en,'b_content'=>$b_content,
                    'b_content_en'=>$b_content_en,'b_sort'=>$b_sort,'isenable'=>$isenable,'id'=>$rowid]);

    // echo "記錄更新成功";
    $resultData['msg'] = "記錄更新成功";
    $resultData['isSuccess'] = true;
}
if (strval($_POST['dowhat']) == "delete") {
    $name = "";
    $sql = "select banner from  banner_list where rowid = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => intval($_POST['id'])]);
    if ($stmt->rowCount() > 0) {
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            //select column by key and use
            $name = $result['banner'];
        }
       
        if (!empty($name) && file_exists($name)) {
              
            if (unlink($name)) {
          
                $sql = "DELETE FROM  banner_list  WHERE rowid = :id";
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
            $sql = "DELETE FROM  banner_list  WHERE rowid = :id";
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
