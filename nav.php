<?php session_start(); 

date_default_timezone_set("Asia/Taipei");?>

<div class="nav">

    <ul>

<?php

 if(isset($_SESSION['user_id'] )){

if ($_SESSION['user_id'] == 0) {

?>

        <span>

            <li>

                <a href="./index.php">

                    <i class="fas fa-home"></i>

                    首頁

                </a>

            </li>

        </span>

        <span>

            <li>

                <a href="./login.html">

                    <i class="fas fa-sign-in-alt"></i>

                    登入

                </a>

            </li>



        </span>

<?php

}

else {

    if ($_SESSION['user_id']== 2) {

?>

        <span>

            <li>

                <a href="./index.php">

                    <i class="fas fa-home"></i>

                    首頁

                </a>

            </li>

            <li>

                <a href="./profile.php">

                    <i class="fas fa-address-card"></i>

                    隊伍檔案

                </a>

            </li>

        </span>

        <span>

            <li class="li-user-name">

                <a>

                    <i class="fas fa-user"></i>

                    <?php echo $_SESSION['name'];  ?>

                </a>

            </li>

            <li>

                <a href="./change_password.php">

                    <i class="fas fa-pencil-alt"></i>

                    修改密碼

                </a>

            </li>

            <li>

                <a href="./connect/logout.php">

                    <i class="fas fa-sign-out-alt"></i>

                    登出

                </a>

            </li>

        </span>



<?php

    }

    else if ($_SESSION['user_id'] == 3) {

?>

        <span>

            <li>

                <a href="./index.php">

                    <i class="fas fa-home"></i>

                    首頁

                </a>

            </li>

            <li>

                <a href="./profile.php">

                    <i class="fas fa-address-card"></i>

                    隊伍檔案

                </a>

            </li>

            <li>

                <a href="./update.php">

                    <i class="fas fa-file-upload"></i>

                    上傳檔案

                </a>

            </li>

        </span>

        <span>

            <li class="li-user-name">

                <a>

                    <i class="fas fa-user"></i>

                   <?php echo $_SESSION['name'];  ?>

                </a>

            </li>

                <li>

                <a href="./change_password.php">

                    <i class="fas fa-pencil-alt"></i>

                    修改密碼

                </a>

            </li>

            <li>

                <a href="./connect/logout.php">

                    <i class="fas fa-sign-out-alt"></i>

                    登出

                </a>

            </li>

        </span>

<?php

    }

    else if ($_SESSION['user_id'] == 4) {

?>

        <span>

            <li>

                <a href="./index.php">

                    <i class="fas fa-home"></i>

                    首頁

                </a>

            </li>

            <li>

                <a href="./login_time.php">

                    <i class="fas fa-tasks"></i>

                    查看登入狀況

                </a>

            </li>

            <li>

                <a href="./create_member.php">

                    <i class="fas fa-cog"></i>

                    設定登入人員名單

                </a>

            </li>

        </span>

        <span>

            <li class="li-user-name">

                <a>

                    <i class="fas fa-user"></i>

                    <?php echo $_SESSION['name'];  ?>

                </a>

            </li>

            <li>

                <a href="./connect/logout.php">

                    <i class="fas fa-sign-out-alt"></i>

                    登出

                </a>

            </li>

        </span>

<?php

    }

    else if ($_SESSION['user_id']== 1) {

?>

        <span>

            <li>

                <a href="./index.php">

                    <i class="fas fa-home"></i>

                    首頁

                </a>

            </li>

            <li>

                <a href="./score.php">

                    <i class="fas fa-chart-bar"></i>

                    評分成績

                </a>

            </li>

        </span>

        <span>

            <li class="li-user-name">

                <a>

                    <i class="fas fa-user"></i>

                    <?php echo $_SESSION['name'];  ?>

                </a>

            </li>

            <li>

                <a href="./connect/logout.php">

                    <i class="fas fa-sign-out-alt"></i>

                    登出

                </a>

            </li>

        </span>

<?php

    }

    else if ($_SESSION['user_id'] == 5) {

?>

        <span>

            <li>

                <a href="./index.php">

                    <i class="fas fa-home"></i>

                    首頁

                </a>

            </li>

            <li>

                <a href="./login_time.php">

                    <i class="fas fa-tasks"></i>

                    查看登入狀況

                </a>

            </li>

            <li>

                <a href="./create_member.php">

                    <i class="fas fa-cog"></i>

                    設定登入人員名單

                </a>

            </li>

            <li>

                <a href="./create_dir.php">

                    <i class="fas fa-folder-open"></i>

                    新增作品資料夾

                </a>

            </li>

            <li>

                <a href="./score_list.php">

                    <i class="fas fa-chart-bar"></i>

                    觀看成績

                </a>

            </li>

        </span>

        <span>

            <li class="li-user-name">

                <a>

                    <i class="fas fa-user"></i>

                    <?php echo $_SESSION['name'];  ?>

                </a>

            </li>

            <li>

                <a href="./connect/logout.php">

                    <i class="fas fa-sign-out-alt"></i>

                    登出

                </a>

            </li>

        </span>

        <?php

    }

}

}

else

{

    ?>

        <span>

            <li>

                <a href="./index.php">

                    <i class="fas fa-home"></i>

                    首頁

                </a>

            </li>

        </span>

        <span>

            <li>

                <a href="./login.html">

                    <i class="fas fa-sign-in-alt"></i>

                    登入

                </a>

            </li>

        </span>

        <?php

}

?>

    </ul>

</div>

