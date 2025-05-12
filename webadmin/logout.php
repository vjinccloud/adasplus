<?php 
if (!session_id()) session_start();
 $_SESSION['Login_success'] =false;
 $_SESSION['userdata']=null;
 session_unset();
    header("Location:index.php");

?>