<?php
require_once("include/db_connect.php");
require_once("include/inc_func.php");

$resultData = array();
$resultData['msg'] = "";
$resultData['data'] = null;
$resultData['isSuccess'] = false;

$a_title="";
if(isset($_POST['title'])){
    $a_title=myStripslashes( $_POST['title']);
}
$a_title_en="";
if(isset($_POST['title_en'])){
    $a_title_en=myStripslashes( $_POST['title_en']);
}
$textarea1="";
if(isset($_POST['textarea1'])){
    $textarea1=myStripslashes( $_POST['textarea1']);
}
$textarea1_en="";
if(isset($_POST['textarea1_en'])){
    $textarea1_en=myStripslashes( $_POST['textarea1_en']);
}

$illustrate1_title="";
if(isset($_POST['illustrate1_title'])){
    $illustrate1_title=myStripslashes( $_POST['illustrate1_title']);
}
$illustrate1_textarea1="";
if(isset($_POST['illustrate1_textarea1'])){
    $illustrate1_textarea1=myStripslashes( $_POST['illustrate1_textarea1']);
}
$illustrate1_title_en="";
if(isset($_POST['illustrate1_title_en'])){
    $illustrate1_title_en=myStripslashes( $_POST['illustrate1_title_en']);
}
$illustrate1_textarea1_en="";
if(isset($_POST['illustrate1_textarea1_en'])){
    $illustrate1_textarea1_en=myStripslashes( $_POST['illustrate1_textarea1_en']);
}

$illustrate2_title="";
if(isset($_POST['illustrate2_title'])){
    $illustrate2_title=myStripslashes( $_POST['illustrate2_title']);
}
$illustrate2_textarea1="";
if(isset($_POST['illustrate2_textarea1'])){
    $illustrate2_textarea1=myStripslashes( $_POST['illustrate2_textarea1']);
}
$illustrate2_title_en="";
if(isset($_POST['illustrate1_title_en'])){
    $illustrate2_title_en=myStripslashes( $_POST['illustrate2_title_en']);
}
$illustrate2_textarea1_en="";
if(isset($_POST['illustrate2_textarea1_en'])){
    $illustrate2_textarea1_en=myStripslashes( $_POST['illustrate2_textarea1_en']);
}

$illustrate3_title="";
if(isset($_POST['illustrate3_title'])){
    $illustrate3_title=myStripslashes( $_POST['illustrate3_title']);
}
$illustrate3_textarea1="";
if(isset($_POST['illustrate3_textarea1'])){
    $illustrate3_textarea1=myStripslashes( $_POST['illustrate3_textarea1']);
}
$illustrate3_title_en="";
if(isset($_POST['illustrate3_title_en'])){
    $illustrate3_title_en=myStripslashes( $_POST['illustrate3_title_en']);
}
$illustrate3_textarea1_en="";
if(isset($_POST['illustrate3_textarea1_en'])){
    $illustrate3_textarea1_en=myStripslashes( $_POST['illustrate3_textarea1_en']);
}



$dowhat = myStripslashes($_POST['dowhat']);
if ($dowhat == 'query') {
    $sql = "select * from about_list";
    $result = $pdo->query($sql);
    $temparr = array();
    while ($stmt = $result->fetch(PDO::FETCH_ASSOC)) {
        //select column by key and use
        array_push($temparr, [ 'rowid' => $stmt['rowid'],'a_title'=>$stmt['a_title'],'a_title_en'=>$stmt['a_title_en']
        ,'textarea1' => htmlspecialchars_decode($stmt['textarea1']),'textarea1_en' => htmlspecialchars_decode($stmt['textarea1_en']),'illustrate1_title'=>$stmt['illustrate1_title'],
        'illustrate1_textarea1'=>$stmt['illustrate1_textarea1'],'illustrate1_title_en'=>$stmt['illustrate1_title_en'],'illustrate1_textarea1_en'=>$stmt['illustrate1_textarea1_en'],
        'illustrate2_title'=>$stmt['illustrate2_title'],'illustrate2_textarea1'=>$stmt['illustrate2_textarea1'],'illustrate2_title_en'=>$stmt['illustrate2_title_en'],
        'illustrate2_textarea1_en'=>$stmt['illustrate2_textarea1_en'],'illustrate3_title'=>$stmt['illustrate3_title'],'illustrate3_textarea1'=>$stmt['illustrate3_textarea1'],
        'illustrate3_title_en'=>$stmt['illustrate3_title_en'],'illustrate3_textarea1_en'=>$stmt['illustrate3_textarea1_en']]);
    }
    $resultData['msg'] = "資料搜尋成功";
    $resultData['data'] = $temparr;
    $resultData['isSuccess'] = true;
    //  echo json_encode($result->fetch(PDO::FETCH_ASSOC),JSON_UNESCAPED_UNICODE);
    echo json_encode($resultData, JSON_UNESCAPED_UNICODE);
    //return json_encode( $result->fetch(PDO::FETCH_ASSOC));
}


if ($dowhat == 'edit') {
    
 
    $sql = "select rowid from about_list";
    $result = $pdo->query($sql);
    $count = $result->rowCount();
    if ($count > 0) {
        $rowid = 0;
        while ($stmt = $result->fetch(PDO::FETCH_ASSOC)) {
            //select column by key and use
            $rowid = $stmt['rowid'];
        }
        $sql = "UPDATE about_list SET a_title = :a_title,a_title_en=:a_title_en,textarea1=:textarea1,textarea1_en=:textarea1_en,illustrate1_title=:illustrate1_title,illustrate1_textarea1=:illustrate1_textarea1,illustrate1_title_en=:illustrate1_title_en,illustrate1_textarea1_en=:illustrate1_textarea1_en, ";
         $sql .=" illustrate2_title=:illustrate2_title,illustrate2_textarea1=:illustrate2_textarea1,illustrate2_title_en=:illustrate2_title_en,illustrate2_textarea1_en=:illustrate2_textarea1_en,illustrate3_title=:illustrate3_title,illustrate3_textarea1=:illustrate3_textarea1,illustrate3_title_en=:illustrate3_title_en,illustrate3_textarea1_en=:illustrate3_textarea1_en WHERE rowid = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['a_title' => $a_title,'a_title_en'=>$a_title_en,'textarea1'=>$textarea1,'textarea1_en'=>$textarea1_en,'illustrate1_title'=>$illustrate1_title,'illustrate1_textarea1'=>$illustrate1_textarea1,'illustrate1_title_en'=>$illustrate1_title_en,'illustrate1_textarea1_en'=>$illustrate1_textarea1_en
        ,'illustrate2_title'=>$illustrate2_title,'illustrate2_textarea1'=>$illustrate2_textarea1,'illustrate2_title_en'=>$illustrate2_title_en,'illustrate2_textarea1_en'=>$illustrate2_textarea1_en 
        ,'illustrate3_title'=>$illustrate3_title,'illustrate3_textarea1'=>$illustrate3_textarea1,'illustrate3_title_en'=>$illustrate3_title_en,'illustrate3_textarea1_en'=>$illustrate3_textarea1_en,'id' => $rowid]);

        // echo "記錄更新成功";
        $resultData['msg'] = "記錄更新成功";
        $resultData['isSuccess'] = true;
    } else {


        $sql = "INSERT INTO about_list (a_title,a_title_en,textarea1,textarea1_en,illustrate1_title,illustrate1_textarea1,illustrate1_title_en,illustrate1_textarea1_en,illustrate2_title,illustrate2_textarea1,illustrate2_title_en,illustrate2_textarea1_en,illustrate3_title,illustrate3_textarea1,illustrate3_title_en,illustrate3_textarea1_en) ";
        $sql.=" VALUES (:a_title,:a_title_en,:textarea1,:textarea1_en,:illustrate1_title,:illustrate1_textarea1,:illustrate1_title_en,:illustrate1_textarea1_en,:illustrate2_title,:illustrate2_textarea1,:illustrate2_title_en,:illustrate2_textarea1_en ";
        $sql .=" ,:illustrate3_title,:illustrate3_textarea1,:illustrate3_title_en,:illustrate3_textarea1_en)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['a_title' => $a_title,'a_title_en'=>$a_title_en,'textarea1'=>$textarea1,'textarea1_en'=>$textarea1_en
        ,'illustrate1_title'=>$illustrate1_title,'illustrate1_textarea1'=>$illustrate1_textarea1,'illustrate1_title_en'=>$illustrate1_title_en,'illustrate1_textarea1_en'=>$illustrate1_textarea1_en
        ,'illustrate2_title'=>$illustrate2_title,'illustrate2_textarea1'=>$illustrate2_textarea1,'illustrate2_title_en'=>$illustrate2_title_en,'illustrate2_textarea1_en'=>$illustrate2_textarea1_en 
        ,'illustrate3_title'=>$illustrate3_title,'illustrate3_textarea1'=>$illustrate3_textarea1,'illustrate3_title_en'=>$illustrate3_title_en,'illustrate3_textarea1_en'=>$illustrate3_textarea1_en]);

        // echo "新記錄插入成功，ID: " . $pdo->lastInsertId();
        $resultData['msg'] = "新記錄插入成功";
        $resultData['isSuccess'] = true;
    }
    echo json_encode($resultData, JSON_UNESCAPED_UNICODE);
}
