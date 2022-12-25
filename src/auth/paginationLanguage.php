<?php

include("../utils/dbConnection.php");
$sql = "SELECT * FROM language";
$result = mysqli_query($conn, $sql);
$languages = mysqli_fetch_all($result, MYSQLI_ASSOC);

$start = ($_REQUEST['page'] - 1) * 5;
$end = ($start + 5);
$listLanguage = array();

foreach ($languages as $index => $language) {
    if ($start <= $index && $index < $end) {
        array_push($language, $genre);
    }
}
echo json_encode($listLanguage, JSON_UNESCAPED_UNICODE);
