<?php

include("../utils/dbConnection.php");
$sql = "SELECT songs.id, songs.title, songs.imgPath, songs.filePath, songs.dateAdded, songs.fileType, language.title as languageTitle, genre.title as genreTitle, album.title as albumTitle, singers.name as singerTitle, songs.year FROM songs
inner join singers on songs.singerID=singers.id  
inner join language on songs.languageID=language.id
inner join genre on songs.genereID=genre.id
inner join album on songs.albumID=album.id WHERE songs.fileType='audio';";
$result = mysqli_query($conn, $sql);
$songs = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
$start = ($_REQUEST['page']- 1)*5;
    $end = ($start + 5);
$listSong = array();

    foreach ($songs as $index => $song){
        if($start <= $index && $index < $end){
            array_push ($listSong, $song);
        }
    }
    echo json_encode($listSong, JSON_UNESCAPED_UNICODE);

?>