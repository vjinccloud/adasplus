<?php

require_once("include/db_connect.php");
require_once("include/inc_func.php");
require_once("vendor/autoload.php");

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// if(!isset($_SESSION)){
//     session_start();
// }

$resultData = array();
$resultData['msg'] = "";
$resultData['data'] = null;
$resultData['isSuccess'] = false;



$rowid = 0;
if (isset($_POST['id'])) {
    $rowid = intval($_POST['id']);
}


$username = "";
if (isset($_POST['username'])) {
    $username = myStripslashes($_POST['username']);
}

$messagecontent = "";
if (isset($_POST['messagecontent'])) {
    $messagecontent = myStripslashes($_POST['messagecontent']);
}
$phone = "";
if (isset($_POST['phone'])) {
    $phone = myStripslashes($_POST['phone']);
}
$email = "";
if (isset($_POST['email'])) {
    $email = myStripslashes($_POST['email']);
}
$processingrecords = "";
if (isset($_POST['processingrecords'])) {
    $processingrecords = myStripslashes($_POST['processingrecords']);
}
$storytheme = "";
if (isset($_POST['storytheme'])) {
    $storytheme = myStripslashes($_POST['storytheme']);
}

$statussettings = 0;
if (isset($_POST['status'])) {
    $statussettings = intval($_POST['status']);
}



$dowhat = myStripslashes($_POST['dowhat']);
if ($dowhat == 'query') {
    $sql = "SET NAMES UTF8";
    $result = $pdo->query($sql);
    $sql = "select rowid,username from contact_list";
    $result = $pdo->query($sql);
    $temparr = $result->fetch(PDO::FETCH_ASSOC);

    $resultData['msg'] = "資料搜尋成功";
    $resultData['data'] = $temparr;
    $resultData['isSuccess'] = true;
    //  echo json_encode($result->fetch(PDO::FETCH_ASSOC),JSON_UNESCAPED_UNICODE);
    echo json_encode($resultData, JSON_UNESCAPED_UNICODE);
    //return json_encode( $result->fetch(PDO::FETCH_ASSOC));
}


if ($dowhat == 'edit') {

    try {
        $sql = "UPDATE contact_list SET processingrecords = :processingrecords,statussettings = :statussettings,modifydt=current_timestamp() WHERE rowid = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['processingrecords' => $processingrecords, 'statussettings' => $statussettings, 'id' => $rowid]);

        // var_dump(array($rowid,$statussettings,$username,$sort));
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




    $sql = "INSERT INTO contact_list (username,messagecontent,email,phone,storytheme,createdt) VALUES (:username,:messagecontent,:email,:phone,:storytheme,current_timestamp())";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['username' => $username,  'messagecontent' => $messagecontent, 'email' => $email, 'phone' => $phone, 'storytheme' => $storytheme]);
    sendEmail($username, $phone, $email, $messagecontent);
    // echo "新記錄插入成功，ID: " . $pdo->lastInsertId();
    $resultData['msg'] = "記錄新增成功";
    $resultData['isSuccess'] = true;
}
if (strval($_POST['dowhat']) == "delete") {
    $sql = "DELETE FROM  contact_list  WHERE rowid = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => intval($_POST['id'])]);

    // echo "記錄更新成功";
    $resultData['msg'] = "刪除成功";
    $resultData['isSuccess'] = true;
}
if (strval($dowhat) == "mdelete") {
    $in_array =array( $_POST['delrowids']);
    $in_array=explode(",", $in_array[0]);
    // var_dump($in_array);
    if (count($in_array) <= 0) {
        // echo "記錄更新成功";
        $resultData['msg'] = "刪除失敗";
        $resultData['isSuccess'] = false;
    } else {
        $in  = str_repeat('?,', count($in_array) - 1) . '?';
        $sql = "DELETE FROM  contact_list  WHERE rowid IN ($in)";
        // echo 'in='.$in."<br>".count($in_array);
        // var_dump($in_array);
        $stm = $pdo->prepare($sql);
        $stm->execute($in_array);
        // echo "記錄更新成功";
        $resultData['msg'] = "刪除成功";
        $resultData['isSuccess'] = true;
    }
}
function sendEmail($username, $phone, $email, $messagecontent)
{





    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'adasplusmailserver@gmail.com';                     //SMTP username
        $mail->Password   = 'krnm lnke qukt anpq';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;     //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->CharSet = 'UTF-8';
        $mail->setLanguage('zh', '/vendor/phpmailer/phpmailer/language');

        //Recipients
        $mail->setFrom('adasplusmailserver@gmail.com', 'Adasplus');
        // $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
        $mail->addAddress('tolen48@hotmail.com');
        $mail->addAddress('kc.wu@adasplus-tech.com');
        $mail->addAddress('yangch@adasplus.com.tw');
        $mail->addAddress('arieltvjinc@gmail.com');            //Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = '啟簡系統信';
        $mailbody = "";
        $mailbody = "姓名：" . $username . "<br>";
        $mailbody .= "電話：" . $phone . "<br>";
        $mailbody .= "Email：" . $email . "<br>";
        $mailbody .= "留言內容：" . $messagecontent . "<br>";
        $mail->Body    = $mailbody;
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        // echo 'Message has been sent';
    } catch (Exception $e) {
        // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        $resultData['msg'] = "發信失敗" . $e->getMessage() . " " . $mail->ErrorInfo;
        $resultData['isSuccess'] = false;
    }
}

echo json_encode($resultData, JSON_UNESCAPED_UNICODE);
