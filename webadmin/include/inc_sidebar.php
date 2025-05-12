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
if (!session_id()) session_start();
//讀入設定檔及判斷是否登入
require_once("include/db_connect.php");
require_once("include/inc_func.php");



?>


<ul id="sidebar_menu" class="metismenu">
      <li>
        <a class="has-arrow" href="#" aria-expanded="false">
          <div class="nav_icon_small">
            <img src="./img/12.svg" alt="" />
          </div>
          <div class="nav_title">
            <span>網站管理</span>
          </div>
        </a>
        <ul class="mm-collapse mm-show">
        <li><a href="banner2_management.php">首頁banner管理</a></li>
          <li><a href="website_about_management.php">關於我們-公司介紹</a></li>
          <li><a href="about_position.php">關於我們-成員介紹</a></li>
          <li><a href="website_contact_management.php">聯絡我們</a></li>
        </ul>
      </li>
      <!-- <li class="">
        <a class="has-arrow" href="#" aria-expanded="false">
          <div class="nav_icon_small">
            <img src="./img/12.svg" alt="" />
          </div>
          <div class="nav_title">
            <span>最新消息</span>
          </div>
        </a>
        <ul class="mm-collapse">
        
          <li><a href="about_position.php">最新消息</a></li>
        </ul>
      </li> -->
      <li class="">
        <a
          href="account_management.php"
          aria-expanded="false"
          class="active">
          <div class="nav_icon_small">
            <img src="./img/12.svg" alt="" />
          </div>
          <div class="nav_title">
            <span>帳號管理</span>
          </div>
        </a>
      </li>
    </ul>