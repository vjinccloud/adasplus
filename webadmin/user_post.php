<?php
//设置当前目录下session子文件夹为session保存路径。
// $sessSavePath = dirname(__FILE__).'/sessions/';
// chmod($sessSavePath, 0777);
// //如果新路径可读可写（可通过FTP上变更文件夹属性为777实现），则让该路径生效。
// if(is_writeable($sessSavePath) && is_readable($sessSavePath) )
// {
    
//    session_save_path($sessSavePath);
// }else{
//    echo $sessSavePath." 指定session路径不可读写，请修改权限 write=".is_writeable($sessSavePath)." read=".is_readable($sessSavePath)." fileperms=".substr ( sprintf ( "%o" , fileperms ( $sessSavePath ) ) , - 4 );
// }
// clearstatcache();
if (!session_id()) session_start();
require_once("include/db_connect.php");
require_once("include/inc_func.php");

// if(!isset($_SESSION)){
//     session_start();
// }

$resultData = array();
$resultData['msg'] = "";
$resultData['data'] = null;
$resultData['isSuccess'] = false;

$userdata = array();
$userdata['name'] = "";
$userdata['id'] = 0;
$userdata['roleid'] = 0;

$rowid = 0;
if (isset($_POST['id'])) {
    $rowid = intval($_POST['id']);
}


$username = "";
if (isset($_POST['username'])) {
    $username = myStripslashes($_POST['username']);
}
$account = "";
if (isset($_POST['account'])) {
    $account = myStripslashes($_POST['account']);
}
$password = "";
if (isset($_POST['password'])) {
    $password = myStripslashes($_POST['password']);
}


$isenable = 0;
if (isset($_POST['enable'])) {
    $isenable = intval($_POST['enable']);
}



$dowhat = myStripslashes($_POST['dowhat']);
if ($dowhat == 'query') {
    $sql="SET NAMES UTF8";
$result=$pdo->query($sql);
    $sql = "select rowid,username,account from user_list";
    $result = $pdo->query($sql);
    $temparr = $result->fetch(PDO::FETCH_ASSOC);

    $resultData['msg'] = "資料搜尋成功";
    $resultData['data'] = $temparr;
    $resultData['isSuccess'] = true;
    //  echo json_encode($result->fetch(PDO::FETCH_ASSOC),JSON_UNESCAPED_UNICODE);
    echo json_encode($resultData, JSON_UNESCAPED_UNICODE);
    //return json_encode( $result->fetch(PDO::FETCH_ASSOC));
}
if ($dowhat == 'login') {
    // $sql = "SET NAMES UTF8";
    // $result = $pdo->query($sql);
    
    $sql = "select rowid,password,username from user_list where account=:account and isenable=1 limit 1 ";
    $result = $pdo->prepare($sql);

    $result->execute(['account' => $account]);
    $temparr = $result->fetch(PDO::FETCH_ASSOC);
    if ($result->rowCount() > 0) {
        $password_hash = $temparr['password'];
       
        if (password_verify($password, $password_hash)) {
            
            //登入成功
            $_SESSION['Login_success'] = true;

            $userdata['name'] =  $temparr['username'];
          
            $userdata['id'] = intval($temparr['rowid']);;
            
            $_SESSION['userdata']=$userdata;

        
            $resultData['msg'] = "登入成功";
            $resultData['data'] = "website_about_management.php";
            $resultData['isSuccess'] = true;
        } else {
            $resultData['msg'] = "登入失敗 帳號或密碼錯誤";
            $resultData['data'] = null;
            $resultData['isSuccess'] = false;
        }
    } else {
        $resultData['msg'] = "登入失敗 帳號或密碼錯誤";
        $resultData['data'] = null;
        $resultData['isSuccess'] = false;
    }
}

if ($dowhat == 'edit') {
   
    try {
        $sql = "UPDATE user_list SET account = :account,username = :username,isenable=:isenable,modifydt=current_timestamp() WHERE rowid = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['account' => $account, 'username' => $username, 'id' => $rowid, 'isenable' => $isenable]);
        if (!empty($password)) {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE user_list SET password=:password where rowid=:id ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['password' => $password, 'id' => $rowid]);
        }
        // var_dump(array($rowid,$isenable,$username,$sort));
        // echo "記錄更新成功";
        $resultData['msg'] = "記錄更新成功";
        $resultData['isSuccess'] = true;
    } catch (PDOException $e) {
        //echo "連線失敗: " . $e->getMessage();
        $resultData['msg'] = "記錄更新失敗" . $e->getMessage();
        $resultData['isSuccess'] = false;
    }
}
if (strval($_POST['dowhat']) == "add") {

    $password = password_hash($password, PASSWORD_DEFAULT);


    $sql = "INSERT INTO user_list (username,account,password,isenable,createdt) VALUES (:username,:account,:password,:isenable,current_timestamp())";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([ 'username' => $username, 'account' => $account, 'password' => $password , 'isenable' => $isenable]);

    // echo "新記錄插入成功，ID: " . $pdo->lastInsertId();
    $resultData['msg'] = "記錄新增成功";
    $resultData['isSuccess'] = true;
}
if (strval($_POST['dowhat']) == "delete") {
    $sql = "DELETE FROM  user_list  WHERE rowid = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => intval($_POST['id'])]);

    // echo "記錄更新成功";
    $resultData['msg'] = "刪除成功";
    $resultData['isSuccess'] = true;
}
echo json_encode($resultData, JSON_UNESCAPED_UNICODE);
