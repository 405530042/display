<?php
require('connect/connect.php');

session_start();

$res = "";

if (isset($_POST['file_id'])) {

    $stmt = $conn->prepare("SELECT id, direction, file_name FROM update_data WHERE id = ?");

    $stmt->bind_param('i', $_POST['file_id']);

    $stmt->execute();

    $result = $stmt->get_result();

    $stmt->close();

    $row = mysqli_fetch_assoc($result);

    $res .= "<iframe style='pointer-events: none; user-select: none;' type='application/pdf' src='update/" . $row['direction'] . "/" . $row['file_name'] . ".pdf'></iframe>";

}

else {

    $res .= "<h1>開啟檔案出錯。（1 秒後自動重新整理）</h1>";

}

echo $res;

?>