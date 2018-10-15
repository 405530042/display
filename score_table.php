<?php 

include('./connect/connect.php');

session_start();

$res = "";

$res .= "<thead>";

$res .= "    <tr>";

$res .= "        <th> 專題名稱 </th>";

$res .= "        <th> 組別 </th>";

$res .= "        <th> 成績 </th>";

$res .= "        <th id='select-all'></th>";

$res .= "    </tr>";

$res .= "</thead>";

$res .= "<tbody id='data'>";

$categories = $_POST['dirName'];

$stmt = $conn->prepare("SELECT * FROM update_data WHERE direction = ?");

$stmt->bind_param('s', $categories);

$stmt->execute();

$result = $stmt->get_result();

$stmt->close();

$rows = mysqli_num_rows($result);

if ($rows == 0) {

    $res .= "<tr>";

    $res .= "    <td class='td-center'> 資料夾沒有檔案 </td>";

    $res .= "</tr>";

}

else {

    for ($i = 0; $i < $rows; $i++) {

        $row = mysqli_fetch_assoc($result);

        $stmt2 = $conn->prepare("SELECT * FROM score WHERE member_id = ? AND file_id = ?");

        $stmt2->bind_param('ii', $_SESSION['id'], $row['id']);

        $stmt2->execute();

        $result2 = $stmt2->get_result();

        $stmt2->close();

        $rows2 = mysqli_num_rows($result2);

        $row2 = mysqli_fetch_assoc($result2);

        if ($rows2 == 0) {

            $scoreResult = "無";

        }

        else {

            $scoreResult = (0.30 * $row2['start']) 
                         + (0.25 * $row2['conception']) 
                         + (0.25 * $row2['mode']) 
                         + (0.10 * $row2['integrity']) 
                         + (0.10 * $row2['consistency']);

        }

        $res .= "<tr>";

        $res .= "    <td>" . $row['file_name'] . "</td>";

        $res .= "    <td class='td-center'>" . $row['team'] . "</td>";

        $res .= "    <td class='td-center'>" . $scoreResult . "</td>";

        $res .= "    <td class='td-center'>";

        if ($scoreResult == "無") {

            $res .= "        <input type='checkbox' name='file_to_be_score' value='" . $row['file_name'] . "'>";

        }

        $res .= "    </td>";

        $res .= "</tr>";

    }

    $res .= "<tr class='tr-submit-area'>";

    $res .= "    <td>";

    $res .= "        <div class='form-group submit-area'>";

    $res .= "            <button type='submit' onclick='return scored();'> 評分成績 </button>";

    $res .= "        </div>";

    $res .= "    </td>";

    $res .= "</tr>";

}

$res .= "</tbody>";

echo $res;

?>