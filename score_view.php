<?php
require('connect/connect.php');

session_start();

$res = "";

$categories = $_POST['fileId'];

$stmt = $conn->prepare("SELECT * FROM score WHERE file_id = ?");

$stmt->bind_param('i', $categories);

$stmt->execute();

$result = $stmt->get_result();

$stmt->close();

$rows = mysqli_num_rows($result);

if ($rows == 0) {

    $res .= "<tr>";

    $res .= "    <td class='td-center'>";

    $res .= "        尚無成績";

    $res .= "    </td>";

    $res .= "</tr>";

}

else {
    
    if($_SESSION['misjudge']==0){
        $row = mysqli_fetch_assoc($result);

        $stmt2 = $conn->prepare("SELECT id, name FROM member WHERE id = ?");

        $stmt2->bind_param('i', $row['member_id']);

        $stmt2->execute();

        $result2 = $stmt2->get_result();

        $stmt2->close();

        $row2 = mysqli_fetch_assoc($result2);

        $totalScore = $row['start'] 
                    + $row['conception'] 
                    + $row['mode'] 
                    + $row['integrity'] 
                    + $row['consistency'];

        $res .= "<tr>";

        $res .= "    <th> " . $_POST['fileName'] . " </th>";

        $res .= "    <th style='width: 120px;'> " . $row['start'] . " </th>";

        $res .= "    <th style='width: 120px;'> " . $row['conception'] . " </th>";

        $res .= "    <th style='width: 120px;'> " . $row['mode'] . " </th>";

        $res .= "    <th style='width: 120px;'> " . $row['integrity'] . " </th>";

        $res .= "    <th style='width: 120px;'> " . $row['consistency'] . " </th>";

        $res .= "    <th style='width: 52px;'> " . $totalScore . " </th>";

        $res .= "    <th style='width: 70px;'> " . $row2['name'] . " </th>";

        $res .= "</tr>";

    }
    else{
        $row = mysqli_fetch_assoc($result);

        $stmt2 = $conn->prepare("SELECT id, name FROM member WHERE id = ?");

        $stmt2->bind_param('i', $row['member_id']);

        $stmt2->execute();

        $result2 = $stmt2->get_result();

        $stmt2->close();

        $row2 = mysqli_fetch_assoc($result2);

        $totalScore = $row['innovation'] 
                    + $row['complete'] 
                    + $row['presentation'];

        $res .= "<tr>";

        $res .= "    <th> " . $_POST['fileName'] . " </th>";

        $res .= "    <th style='width: 120px;'> " . $row['innovation'] . " </th>";

        $res .= "    <th style='width: 120px;'> " . $row['complete'] . " </th>";

        $res .= "    <th style='width: 120px;'> " . $row['presentation'] . " </th>";

        $res .= "    <th style='width: 52px;'> " . $totalScore . " </th>";

        $res .= "    <th style='width: 70px;'> " . $row2['name'] . " </th>";

        $res .= "</tr>";
    }
}

echo $res;

?>
