
<?php
try {
    $dsn = 'mysql:host=localhost;dbname=web_website';
    $username = 'web';
    $password = 'Gs2asmOKoDm@xxak';

   $pdo=dbconnect($dsn, $username, $password);

   echo "連線成功";
} catch (PDOException $e) {
    echo "連線失敗: " . $e->getMessage();
}
function dbconnect($dsn, $username, $password){
 // 建立 PDO 連線
 $pdo = new PDO($dsn, $username, $password);

 // 設定 PDO 錯誤模式為異常
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 return $pdo;
}
?>