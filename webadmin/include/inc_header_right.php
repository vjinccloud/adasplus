<?php

if (!isset($_SESSION)) {
    session_start();
}


?>


<div
    class="header_right d-flex justify-content-between align-items-center">
    <div class="profile_info">
        <img src="./img/client_img.png" alt="#" />
        <div class="profile_info_iner">
            <div class="profile_author_name">
                <!-- <p>240001</p> -->
                <h5><?php echo $_SESSION['userdata']['name'] ?></h5>
            </div>
            <div class="profile_info_details">
                <a href="logout.php">登出
                </a>
            </div>
        </div>
    </div>
</div>