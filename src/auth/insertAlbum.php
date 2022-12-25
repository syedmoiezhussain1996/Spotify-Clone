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

$name = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql2 = "SELECT * FROM album WHERE id= '$id' ";
    $res2 = mysqli_query($conn, $sql2);
    $data = mysqli_fetch_array($res2);
    $name = $data["title"];
}


$errors = array('albumname' => '');
$albumname = '';



// INSERT GENRE INTO DATABASE
if (isset($_POST['submit'])) {
    if (empty($_POST['albumname'])) {
        $errors['albumname'] = "Album's name can not be empty";
    } else {
        $albumname = $_POST['albumname'];
    }


    if (array_filter($errors)) {
        echo 'Form not valid';
    } else {
        //IF GET ID -> UPDATE IT
        if (isset($_GET['id'])) {
            $updateAlbum = "UPDATE album SET title = '$albumname' WHERE id =$id";
            $res3 = mysqli_query($conn, $updateAlbum);
            header("Location: editAlbum.php");
        } else {
            $insertAlbum = "INSERT INTO album(title)
            VALUES ('$albumname')";
            if (!mysqli_query($conn, $insertAlbum)) {
                echo  "Error: " . "<br>" . mysqli_error($conn);
            } else {
                header("Location: editAlbum.php");
            }
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Album</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <form method="POST" enctype="multipart/form-data">
        <?php foreach ($errors as $error) : ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endforeach; ?>
        <h2>Album</h2>

        <label>Name</label>
        <input type="text" name="albumname" placeholder="Album name" value="<?php echo $name; ?>"><br>
        <a href="editAlbum.php" class="ca">BACK</a>

        <button type="submit" name="submit">SUBMIT</button>
    </form>
</body>

</html>