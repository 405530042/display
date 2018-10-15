<?php
require('connect/connect.php');

session_start();

$res = "";

$categories = $_POST['dirName'];

$stmt = $conn->prepare("SELECT * FROM update_data WHERE direction = ?");

$stmt->bind_param('s', $categories);

$stmt->execute();

$result = $stmt->get_result();

$stmt->close();

$rows = mysqli_num_rows($result);

if ($rows == 0) {

    $res .= "<h1> 資料夾沒有檔案 </h1>";

}

else {

    for ($i = 0; $i < $rows; $i++) {

        $row = mysqli_fetch_assoc($result);

        $url = "./update/img/" . $row['direction'] . "/" . $row['image'] . ".jpg";

        if (!file_exists($url)) $url = "./img/PDF.png";

        $res .= "<li class='profile-box'>";

        $res .= "    <a onclick='li3(" . $row['id'] . ", \"" . $row['file_name'] . "\")'>";

        $res .= "        <div class='cover' style='background-image: url(" . $url . ");'></div>";

        $res .= "    </a>";

        $res .= "    <div class='title'>";

        $res .= "        <span> " . $row['file_name'] . "</span>";

        $res .= "    </div>";

        $res .= "</li>";

    }

}

echo $res;

?>
