<?php
require('connect/connect.php');

session_start();

$res = "";

if (isset($_POST['scoreFile'])) {

    $files = $_POST['scoreFile'];

    $res .= "<thead>";

    $res .= "    <tr>";

    $res .= "        <th> 專題名稱 </th>";

    $res .= "        <th style='width: 120px;'> 創業<br>可執行性<br>(30%) </th>";

    $res .= "        <th style='width: 120px;'> 創業構想與<br>市場機會<br>(25%) </th>";

    $res .= "        <th style='width: 120px;'> 產品或<br>服務模式<br>(25%) </th>";

    $res .= "        <th style='width: 120px;'> 企劃內容<br>架構完整性<br>(10%) </th>";

    $res .= "        <th style='width: 120px;'> 企劃內容<br>一致性<br>(10%) </th>";

    $res .= "    </tr>";

    $res .= "</thead>";

    $res .= "<tbody id='data'>";

    for ($i = 0; $i < count($files); $i++) {

        $stmt = $conn->prepare("SELECT id, file_name FROM update_data WHERE file_name = ?");

        $stmt->bind_param('s', $files[$i]);

        $stmt->execute();

        $result = $stmt->get_result();

        $stmt->close();

        $row = mysqli_fetch_assoc($result);

        $res .= "<tr>";

        $res .= "    <td>";

        $res .= "        " . $files[$i] . "<input type='hidden' name='the_upload_file[]' value='" . $row['id'] . "'>";

        $res .= "    </td>";

        $res .= "    <td class='td-center'>";

        $res .= "        <div class='form-group'>";

        $res .= "            <input type='number' min='0' max='30' name='start[]' required>";

        $res .= "        </div>";

        $res .= "    </td>";

        $res .= "    <td class='td-center'>";

        $res .= "        <div class='form-group'>";

        $res .= "            <input type='number' min='0' max='25' name='conception[]' required>";

        $res .= "        </div>";

        $res .= "    </td>";

        $res .= "    <td class='td-center'>";

        $res .= "        <div class='form-group'>";

        $res .= "            <input type='number' min='0' max='25' name='mode[]' required>";

        $res .= "        </div>";

        $res .= "    </td>";

        $res .= "    <td class='td-center'>";

        $res .= "        <div class='form-group'>";

        $res .= "            <input type='number' min='0' max='10' name='integrity[]' required>";

        $res .= "        </div>";

        $res .= "    </td>";

        $res .= "    <td class='td-center'>";

        $res .= "        <div class='form-group'>";

        $res .= "            <input type='number' min='0' max='10' name='consistency[]' required>";

        $res .= "        </div>";

        $res .= "    </td>";

        $res .= "</tr>";

    }

    $res .= "<tr class='tr-submit-area'>";

    $res .= "    <td>";

    $res .= "        <div class='form-group submit-area'>";

    $res .= "            <button type='submit'> 送出成績 </button>";

    $res .= "        </div>";

    $res .= "    </td>";

    $res .= "</tr>";

    $res .= "</tbody>";

}

else {

    $res .= "沒有選擇欲評分之專題。（1 秒後自動重新整理）";

}

echo $res;

?>