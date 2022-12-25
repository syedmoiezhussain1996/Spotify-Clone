<?php
include('./auth.php');

if (!$authenticated) {
    header("Location: ./login.php");
} else {
    if (!$admin) {
        header("Location: ./unauth.php");
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/editSong.css">
</head>

<body>
    <a class="ca2" href="../index.php" style="margin: 10px 10px;"><strong>HOME</strong></a>
    <div class="dashboard">
        <div class="icon-dashboard">
            <label>USERS</label>
            <a href="updateUser.php">
                <i class="fas fa-users fa-7x"></i></a>
        </div>

        <div class="icon-dashboard">
            <label>AUDIO SONGS</label>
            <a href="editSong.php"><i class="fas fa-music fa-7x"></i></a>
        </div>

        <div class="icon-dashboard">
            <label>SINGERS</label>
            <a href="editSinger.php"><i class="fas fa-microphone fa-7x"></i></a>
        </div>
        <div class="icon-dashboard">
            <label>VIDEO SONGS</label>
            <a href="editSong.php"><i class="fas fa-film fa-7x"></i></a>
        </div>

    </div>



</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/6e6c14e530.js" crossorigin="anonymous"></script>

</html>