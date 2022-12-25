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
    $sql2 = "SELECT * FROM language WHERE id= '$id' ";
    $res2 = mysqli_query($conn, $sql2);
    $data = mysqli_fetch_array($res2);
    $name = $data["title"];
}


$errors = array('languagename' => '');
$languagename = '';



// INSERT GENRE INTO DATABASE
if (isset($_POST['submit'])) {
    if (empty($_POST['languagename'])) {
        $errors['languagename'] = "Language's name can not be empty";
    } else {
        $languagename = $_POST['languagename'];
    }


    if (array_filter($errors)) {
        echo 'Form not valid';
    } else {
        //IF GET ID -> UPDATE IT
        if (isset($_GET['id'])) {
            $updateLanguage = "UPDATE language SET title = '$languagename' WHERE id =$id";
            $res3 = mysqli_query($conn, $updateLanguage);
            header("Location: editLanguage.php");
        } else {
            $insertLanguage = "INSERT INTO language(title)
            VALUES ('$languagename')";
            if (!mysqli_query($conn, $insertLanguage)) {
                echo  "Error: " . "<br>" . mysqli_error($conn);
            } else {
                header("Location: editLanguage.php");
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
    <title>Insert Language</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <form method="POST" enctype="multipart/form-data">
        <?php foreach ($errors as $error) : ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endforeach; ?>
        <h2>Language</h2>

        <label>Name</label>
        <input type="text" name="languagename" placeholder="Language name" value="<?php echo $name; ?>"><br>
        <a href="editLanguage.php" class="ca">BACK</a>

        <button type="submit" name="submit">SUBMIT</button>
    </form>
</body>

</html>