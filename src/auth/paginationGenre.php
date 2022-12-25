<?php

include("../utils/dbConnection.php");
$sql = "SELECT * FROM genre";
$result = mysqli_query($conn, $sql);
$genres = mysqli_fetch_all($result, MYSQLI_ASSOC);

$start = ($_REQUEST['page'] - 1) * 5;
$end = ($start + 5);
$listGenre = array();

foreach ($genres as $index => $genre) {
    if ($start <= $index && $index < $end) {
        array_push($listGenre, $genre);
    }
}
echo json_encode($listGenre, JSON_UNESCAPED_UNICODE);
