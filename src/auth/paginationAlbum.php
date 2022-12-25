<?php

include("../utils/dbConnection.php");
$sql = "SELECT * FROM album";
$result = mysqli_query($conn, $sql);
$albums = mysqli_fetch_all($result, MYSQLI_ASSOC);

$start = ($_REQUEST['page'] - 1) * 5;
$end = ($start + 5);
$listAlbum = array();

foreach ($albums as $index => $genre) {
    if ($start <= $index && $index < $end) {
        array_push($listAlbum, $genre);
    }
}
echo json_encode($listAlbum, JSON_UNESCAPED_UNICODE);
