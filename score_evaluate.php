<?php 

include('./connect/connect.php');

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if($_SESSION['misjudge']==0){
    $cs1 = count($_POST['start']);

    $cs2 = count($_POST['conception']);

    $cs3 = count($_POST['mode']);

    $cs4 = count($_POST['integrity']);

    $cs5 = count($_POST['consistency']);

    if ($cs1 == $cs2 && $cs1 == $cs3 && $cs1 == $cs4 && $cs1 == $cs5) {

        for ($i = 0; $i < $cs1; $i++) {

            $file_id = htmlspecialchars($_POST['the_upload_file'][$i]);

            $s1 = htmlspecialchars($_POST['start'][$i]);

            $s2 = htmlspecialchars($_POST['conception'][$i]);

            $s3 = htmlspecialchars($_POST['mode'][$i]);

            $s4 = htmlspecialchars($_POST['integrity'][$i]);

            $s5 = htmlspecialchars($_POST['consistency'][$i]);

            $time = htmlspecialchars(date("Y-m-d H:i:s"));

            $stmt = $conn->prepare("INSERT INTO `score` (member_id, file_id, start, conception, mode, integrity, consistency, evaluate_time) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

            $stmt->bind_param('iiiiiiis', $_SESSION['id'], $file_id, $s1, $s2, $s3, $s4, $s5, $time);

            $stmt->execute();

        }
    }
    else {
        printf("Error: %s.\n", $stmt->error);
        echo "發生錯誤，請再試一次。";

    }
    }
    else{
        $cs1 = count($_POST['innovation']);

        $cs2 = count($_POST['complete']);
    
        $cs3 = count($_POST['presentation']);

        if ($cs1 == $cs2 && $cs1 == $cs3) {

            for ($i = 0; $i < $cs1; $i++) {
        $file_id = htmlspecialchars($_POST['the_upload_file'][$i]);

        $s1 = htmlspecialchars($_POST['innovation'][$i]);

        $s2 = htmlspecialchars($_POST['complete'][$i]);

        $s3 = htmlspecialchars($_POST['presentation'][$i]);

        $time = htmlspecialchars(date("Y-m-d H:i:s"));

        $stmt = $conn->prepare("INSERT INTO `score` (member_id, file_id,innovation,complete,presentation,  evaluate_time) VALUES (?, ?, ?, ?, ?, ?)");

        $stmt->bind_param('iiiiis', $_SESSION['id'], $file_id, $s1, $s2, $s3, $time);
        $stmt->execute();
            }
            echo "評分成功。";
        }
        // else {
        //     echo "發生錯誤，請再試一次。";
    
        // }
    }
}

?>

<script type="text/javascript">

    setTimeout(() => {

        window.location ="./score.php";

    }, 1000);

</script>

<?php

?>