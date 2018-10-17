<?php 



include('./connect/connect.php');



require('./template/header.php');



require('./template/nav.php');



require('./connect/function.php');



if ($_SESSION['user_id'] != 1) {



    echo '權限不足';



    // header("refresh:2; url=./index.php");



?>



			<script type="text/javascript">



			    setTimeout(() => {



			        window.location ="./index.php";



			    }, 2000);



            </script>



<?php



}



else {

?>







<div class="pre-container">

    <div class="msg-container">

        <header> 黏仔雲端 </header>



        <div class="page-hint">

            <div> 首頁 > 評分成績 </div>

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

                    <a onclick="li2(`<?php echo $row['dir_name'] ?>`)">

                        <div class="cover" style="background-image: url('./img/FILE.png');"></div>

                    </a>                    

                    <div class="title">

                        <span> <?php echo $row['dir_name'] ?> </span>

                    </div>

                </li>

<?php

    }

?>

            </ul>

        </div>

    </div>

    

    <div class="hr"></div>

    

    <div class="container">

        <div class="info-box">

            <div class="info-title"> 檔案列表 </div>



            <div class="info-content">

                <div class="info-content-table">

                    <form action="score_evaluate.php" method="POST">

                        <table id="score-table">

                            <thead>

                                <tr>

                                    <th> 專題名稱 </th>

                                    <th> 組別 </th>

                                    <th> 成績 </th>

                                    <th id="select-all"></th>

                                </tr>

                            </thead>

                            

                            <tbody id="data">

                                <tr>

                                    <td class="td-center">

                                        尚未選擇資料夾

                                    </td>

                                </tr>

                            </tbody>

                        </table>

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

    function selectAllCheckbox() {

        $('#data input[type="checkbox"]').prop('checked', true);

    }

    function li2(dirName) {

        $('.full-page').show();

        $.ajax({

            url: "score_table.php",

            method: "POST",

            data: {

                dirName: dirName

            },

            complete: function () {

                $('.full-page').hide();

            },

            success: function (res) {

                $('#score-table').html(res);

                let inputToCheckAll = '全選 <input type="checkbox" onclick="selectAllCheckbox()">';

                $('#select-all').html(inputToCheckAll);

            }

        });

    }

    function scored() {

        $('.full-page').show();

        let fileToBeScored = [];

        for (let i = 0; i < $('input[name="file_to_be_score"]:checked').length; i++) {

            fileToBeScored[i] = $('input[name="file_to_be_score"]:checked').eq(i).val();

        }

        $.ajax({

            url: "score_file.php",

            method: "POST",

            data: {

                scoreFile: fileToBeScored

            },

            complete: function () {

                $('.full-page').hide();

            },

            success: function (res) {

                $('#score-table').html(res);

                if (res === '沒有選擇欲評分之專題。（1 秒後自動重新整理）') {

                    setTimeout(() => {

                        location.reload();

                    }, 1000);

                }

            }

        });

        return false;

    }

    function scoredSured() {

        $('.full-page').show();

        let fileToBeScored = [];

        for (let i = 0; i < $('input[name="file_to_be_score"]:checked').length; i++) {

            fileToBeScored[i] = $('input[name="file_to_be_score"]:checked').eq(i).val();

        }

        $.ajax({

            url: "score_file.php",

            method: "POST",

            data: {

                scoreFile: fileToBeScored

            },

            complete: function () {

                $('.full-page').hide();

            },

            success: function (res) {

                $('#score-table').html(res);

            }

        });

        return false;

    }

</script>

<?php

}

require('./template/footer.php');

?>