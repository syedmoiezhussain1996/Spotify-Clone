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
    $sql2 = "SELECT * FROM genre WHERE id= '$id' ";
    $res2 = mysqli_query($conn, $sql2);
    $data = mysqli_fetch_array($res2);
    $name = $data["title"];
}


$errors = array('genrename' => '');
$genrename = '';



// INSERT GENRE INTO DATABASE
if (isset($_POST['submit'])) {
    if (empty($_POST['genrename'])) {
        $errors['genrename'] = "Genre's name can not be empty";
    } else {
        $genrename = $_POST['genrename'];
    }


    if (array_filter($errors)) {
        echo 'Form not valid';
    } else {
        //IF GET ID -> UPDATE IT
        if (isset($_GET['id'])) {
            $updateSinger = "UPDATE genre SET title = '$genrename' WHERE id =$id";
            $res3 = mysqli_query($conn, $updateSinger);
            header("Location: editGenre.php");
        } else {
            $insertSinger = "INSERT INTO genre(title)
            VALUES ('$genrename')";
            if (!mysqli_query($conn, $insertSinger)) {
                echo  "Error: " . "<br>" . mysqli_error($conn);
            } else {
                header("Location: editGenre.php");
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
    <title>Insert Genre</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <form method="POST" enctype="multipart/form-data">
        <?php foreach ($errors as $error) : ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endforeach; ?>
        <h2>Genre</h2>

        <label>Name</label>
        <input type="text" name="genrename" placeholder="Genre name" value="<?php echo $name; ?>"><br>
        <a href="editGenre.php" class="ca">BACK</a>

        <button type="submit" name="submit">SUBMIT</button>
    </form>
</body>

</html>