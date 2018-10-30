<?php 



include('./connect/connect.php');



require('./template/header.php');



require('./template/nav.php');



require('./connect/function.php');



if ($_SESSION['user_id'] != 5) {



    echo '權限不足';



    // header("refresh:2; url=./index.php");



?>



			<script type="text/javascript">



			    setTimeout(() => {



			        window.location ="./index.php";



			    }, 1000);



            </script>



<?php



}



else {

?>







<div class="pre-container">

    <div class="msg-container">

        <header> 黏仔雲端 </header>



        <div class="page-hint">

            <div> 首頁 > 觀看成績 </div>

            <div></div>

        </div>

            

        <div class="hr"></div>



        <div class="profile-area">

            <header>

                <span>

                    資料夾

                </span>

            </header>



            <ul>

<?php 

    $stmt = $conn->prepare("SELECT * FROM direction WHERE status = 0");

    $stmt->execute();

    $result = $stmt->get_result();

    $stmt->close();

	for ($i = 0; $i < mysqli_num_rows($result); $i++) {

   		$row = mysqli_fetch_assoc($result);

?>

            

                <li class="profile-box">

                    <a onclick="li(`<?php echo $row['dir_name'] ; ?>`)">

                        <div class="cover" style="background-image: url('./img/FILE.png');"></div>

                    </a>                    

                    <div class="title">

                        <span> <?php echo $row['dir_name']; ?> </span>

                    </div>

                </li>

<?php

    }

?>

            </ul>

        </div>

            

        <div class="hr"></div>



        <div class="profile-area">

            <header>

                <span>

                    檔案

                </span>

            </header>



            <ul id="file-data">

                <h1> 尚未選擇資料夾 </h1>

            </ul>

        </div>

    </div>

    

    <div class="hr"></div>

    

    <div class="container">

        <div class="info-box">

            <div class="info-title"> 成績列表 </div>



            <div class="info-content">

                <div class="info-content-table">

                    <form action="score_evaluate.php" method="POST">
                    <?php 
                    if($row['dir_name']==0){
                        ?>
                        <table id="score-table">

                            <thead>

                                <tr>

                                    <th> 專題名稱 </th>

                                    <th style="width: 120px;"> 創業<br>可執行性<br>(30%) </th>

                                    <th style="width: 120px;"> 創業構想與<br>市場機會<br>(25%) </th>

                                    <th style="width: 120px;"> 產品或<br>服務模式<br>(25%) </th>

                                    <th style="width: 120px;"> 企劃內容<br>架構完整性<br>(10%) </th>

                                    <th style="width: 120px;"> 企劃內容<br>一致性<br>(10%) </th>

                                    <th style="width: 52px;"> 總分 </th>

                                    <th style="width: 70px;"> 評分人 </th>

                                </tr>

                            </thead>

                            

                            <tbody id="data">

                                <tr>

                                    <td class="td-center">

                                        尚未選擇檔案

                                    </td>

                                </tr>

                            </tbody>

                        </table>
                        <?php 
                    }
                    else{
                        ?>
                         <table id="score-table">

<thead>

    <tr>

        <th> 專題名稱 </th>

        <th style="width: 120px;"> 創新度(主題/技術)(50%) </th>

        <th style="width: 120px;">完整性/實用度(30%) </th>

        <th style="width: 120px;"> 報告分數(20%) </th>

         <th style="width: 52px;"> 總分 </th>

        <th style="width: 70px;"> 評分人 </th>

    </tr>

</thead>



<tbody id="data">

    <tr>

        <td class="td-center">

            尚未選擇檔案

        </td>

    </tr>

</tbody>

</table>
            <?php
                    }
                    ?>
                    </form>

                </div>

            </div>

        </div>

    </div>

</div>



<div class="full-page" style="display: none;">

    <div class="full-page-msg">

        <p>

            Loading......

        </p>

    </div>

</div>

<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>

<script>

    function li(dirName) {

        $('.full-page').show();

        $.ajax({

            url: "score_file_view.php",

            method: "POST",

            data: {

                dirName: dirName

            },

            complete: function () {

                $('.full-page').hide();

            },

            success: function (res) {

                $('#file-data').html(res);

            }

        });

    }

    function li3(fileId, fileName) {

        $('.full-page').show();

        $.ajax({

            url: "score_view.php",

            method: "POST",

            data: {

                fileId: fileId,

                fileName: fileName

            },

            complete: function () {

                $('.full-page').hide();

            },

            success: function (res) {

                $('#data').html(res);

            }

        });

    }

</script>

<?php

}

require('./template/footer.php');

?>