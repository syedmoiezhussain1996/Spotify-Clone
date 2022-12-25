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
$getSingers = "SELECT * from singers";
$result = mysqli_query($conn, $getSingers);
$singers = mysqli_fetch_all($result, MYSQLI_ASSOC);


$titleUpdate = $singerIDfff = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql2 = "SELECT * FROM songs WHERE id= '$id' ";
    $res2 = mysqli_query($conn, $sql2);
    $data = mysqli_fetch_array($res2);
    $titleUpdate = $data["title"];
    $singerIDfff = $data["singerID"];
}

$errors = array('title' => '', 'mp3' => '', 'img' => '');
$title = $mp3 = $img = $singerID = '';

// Save file to sv
function saveFile($fileInfo)
{
    $filename = $fileInfo['name'];
    $type = $fileInfo['type'];
    $folder = (strpos($type, "image") !== false) ? 'images/' : 'music/';

    $tmpPath = $fileInfo['tmp_name'];
    $destinationPath = $folder . $filename;

    if (move_uploaded_file($tmpPath, '../' . $destinationPath)) {
        echo "Successfully uploaded";
    } else {
        echo "Upload fail";
    }

    return $destinationPath;
}

// Handle submit
if (isset($_POST['submit'])) {
    // Title
    if (empty($_POST['title'])) {
        $errors['title'] = "Title cannot be empty";
    } else {
        $title = $_POST['title'];
    }

    // Singer
    $singerID = $_POST['singer'];

    // File mp3
    if (empty($_FILES["mp3"]["name"])) {
        $errors['mp3'] = "Music File cannot be empty";
    } else {
        $mp3 = $_FILES['mp3'];
    }

    // File image
    if (empty($_FILES["image"]["name"])) {
        $errors['image'] = "Image file cannot be empty";
    } else {
        $img = $_FILES['image'];
    }

    // Checking for errors
    if (array_filter($errors)) {
        echo 'Form not valid';
    } else {
        // Insert or Update to db
        $mp3Path = saveFile($mp3);
        $imgPath = saveFile($img);

        if (isset($_GET['id'])) {
            $updateSong = "UPDATE songs SET title = '$title', filePath = '$mp3Path', imgPath = '$imgPath', singerID = '$singerID' WHERE id =$id";
            $res3 = mysqli_query($conn, $updateSong);
            header("Location: editSong.php");
        } else {
            $insertSong = "INSERT INTO songs(title, filePath, imgPath, singerID) 
                             VALUES ('$title', '$mp3Path', '$imgPath', $singerID)";
            if (!mysqli_query($conn, $insertSong)) {
                echo  "Error: " . "<br>" . mysqli_error($conn);
            } else {
                header("Location: editSong.php");
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
    <title>Edit Song</title>
    <link rel="stylesheet" href="./css/song.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div>

    </div>
    <h3 class="notice">UPLOAD SONGS</h3>
    <form class="form-insert" method="POST" enctype="multipart/form-data">
        <?php foreach ($errors as $error) : ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endforeach; ?>

        <div class="col-md-12 row">
            <div class="col-md-4">
                <label for="Title" class="form-control">Title</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="title" id="Title" placeholder="Title" value="<?php echo $titleUpdate; ?>">
            </div>
        </div>
        <div class="mb-3">
            <label for="Singer" class="form-label">Singer</label>
            <!-- <input type="password" class="form-control" id="exampleInputPassword1"> -->
            <select name="singer">
                <?php foreach ($singers as $singer) : ?>
                    <option value='<?php echo $singer['id'] ?>' <?php if ($singer['id'] === $singerIDfff) : ?> selected="selected" <?php endif; ?>>
                        <?php echo $singer['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="genere" class="form-label">Genere</label>
            <select name="genere">
                <?php foreach ($singers as $singer) : ?>
                    <option value='<?php echo $singer['id'] ?>' <?php if ($singer['id'] === $singerIDfff) : ?> selected="selected" <?php endif; ?>>
                        <?php echo $singer['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">MP3 File</label>
            <input class="form-control" type="file" name="mp3" accept="audio/*">
        </div>

        <div class="mb-3">
            <label class="form-label">Images</label>
            <input class="form-control" type="file" name="image" accept="image/*">
        </div>
        <div class="mb-3">
            <a href="editSong.php" class="ca">BACK</a>
            <button type="submit" name="submit">SUBMIT</button>
        </div>

        <!-- <label>Title</label>
            <input type="text" name="title" placeholder="Title" value="<?php echo $titleUpdate; ?>"> -->
        <!-- <label>Singer</label>
            <select name="singer">
                <?php foreach ($singers as $singer) : ?>
                    <option value='<?php echo $singer['id'] ?>' <?php if ($singer['id'] === $singerIDfff) : ?> selected="selected" <?php endif; ?>>
                        <?php echo $singer['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select> -->
        <!-- <label>Genere</label>
            <select name="singer">
                <?php foreach ($singers as $singer) : ?>
                    <option value='<?php echo $singer['id'] ?>' <?php if ($singer['id'] === $singerIDfff) : ?> selected="selected" <?php endif; ?>>
                        <?php echo $singer['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select> -->
        <!-- <button>Add new</button> -->
        <!-- <label>MP3 File</label>
            <input type="file" name="mp3" accept="audio/*"> -->
        <!-- <label>Images</label>
            <input type="file" name="image" accept="image/*"><br> -->
        <!-- <a href="editSong.php" class="ca">BACK</a>
            <button type="submit" name="submit">SUBMIT</button> -->

    </form>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</html>