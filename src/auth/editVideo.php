<?php
include('./auth.php');

if (!$authenticated) {
    header("Location: ./login.php");
} else {
    if (!$admin) {
        header("Location: ./unauth.php");
    }
}

include("../utils/dbConnection.php");
$sql = "SELECT songs.id, songs.title, songs.imgPath, songs.filePath, songs.dateAdded, songs.fileType, language.title as languageTitle, genre.title as genreTitle, album.title as albumTitle, singers.name as singerTitle, songs.year FROM songs
inner join singers on songs.singerID=singers.id  
inner join language on songs.languageID=language.id
inner join genre on songs.genereID=genre.id
inner join album on songs.albumID=album.id WHERE songs.fileType='video';";
$result = mysqli_query($conn, $sql);
$songs = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Song</title>
    <link rel="stylesheet" href="./css/editSong.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="container">
        <div class="link">
            <a class="ca2" href="adminDashboard.php">BACK</a>
        </div>

        <table align="center" border="1" style="border-color: #fff;" class="displaySong">
            <tr>
                <th colspan="12">SONGS INFO</th>
            </tr>
            <tr>
                <th>No</th>
                <th>Images</th>
                <th>Name</th>
                <th>Singer</th>
                <th>Album</th>
                <th>Genre</th>
                <th>Language</th>
                <th>File Path</th>
                <th>File Type</th>
                <th>Year</th>
                <th colspan="3">Operations</th>
            </tr>

            <?php foreach ($songs as $index => $song) : if ($index == 5) break; ?>
                <tr>
                    <td><?php echo $index + 1; ?></td>
                    <td><img style="width: 50px; height: 50px;" src="<?php echo '../' . $song['imgPath'] ?>"></td>
                    <td><?php echo $song['title']; ?></td>
                    <td><?php echo $song['singerTitle']; ?></td>
                    <td><?php echo $song['albumTitle']; ?></td>
                    <td><?php echo $song['genreTitle']; ?></td>
                    <td><?php echo $song['languageTitle']; ?></td>
                    <td><?php echo $song['filePath']; ?></td>
                    <td><?php echo $song['fileType']; ?></td>
                    <td><?php echo $song['year']; ?></td>
                    <td><a style="padding: 5px; background-color: #66FF33; color: #fff; border-radius: 15px; text-decoration: none;" href="insertVideo.php?id=<?php echo $song['id'] ?>">Update</a></td>
                    <td><a style="padding: 5px; background-color: #E3242B; color: #fff; border-radius: 15px; text-decoration: none;" href="deleteVideo.php?id=<?php echo $song['id'] ?>">Delete</a></td>
                </tr>

            <?php endforeach; ?>
        </table>
        <div class="c3"><a href=insertVideo.php>INSERT VIDEO</a></div>
        <div class="paginationButton">
            <ul style="display: flex; list-style-type: none; color: black; margin: 0 auto; justify-content: center;">
                <li onclick="pagination(this.value);" style="padding: 10px;" value="1"> 1</li>
                <li onclick="pagination(this.value);" style="padding: 10px;" value="2"> 2</li>
                <li onclick="pagination(this.value);" style="padding: 10px;" value="3"> 3</li>
            </ul>
        </div>

    </div>


</body>
<script type="text/javascript">
    function pagination(value) {
        let header = `<tr>
                <th colspan="12">SONGS INFO</th>
            </tr>
            <tr>
                <th>No</th>
                <th>Images</th>
                <th>Name</th>
                <th>Singer</th>
                <th>Album</th>
                <th>Genre</th>
                <th>Language</th>
                <th>File Path</th>
                <th>File Type</th>
                <th>Year</th>
                <th colspan="3">Operations</th>
            </tr>`
        let displaySong = document.getElementsByClassName("displaySong")[0];
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let results = JSON.parse(this.responseText);;

                let html = '';
                displaySong.innerHTML = header;

                results.map((value, index) => {
                    html +=
                        ` <tr>
                    <td> ${index + 1}</td>
                    <td><img style="width: 50px; height: 50px;" src='../${value['imgPath']}'></td>
                    <td>${value['title']}</td>
                    <td>${value['singerTitle']}</td>
                    <td>${value['albumTitle']}</td>
                    <td>${value['genreTitle']}</td>
                    <td>${value['languageTitle']}</td>
                    <td>${value['filePath']}</td>
                    <td>${value['fileType']}</td>
                    <td>${value['year']}</td>
                    <td><a style="padding: 5px; background-color: #66FF33; color: #fff; border-radius: 15px; text-decoration: none;" href="insertVideo.php?id=${value['id']}">Update</a></td>
                    <td><a style="padding: 5px; background-color: #E3242B; color: #fff; border-radius: 15px; text-decoration: none;" href="deleteVideo.php?id=${value['id']}">Delete</a></td>
                    </tr>`
                })
                displaySong.innerHTML += html;
            }
        };
        xhttp.open("GET", "paginationVideo.php?page=" + value, true);
        xhttp.send();
    }
</script>

</html>