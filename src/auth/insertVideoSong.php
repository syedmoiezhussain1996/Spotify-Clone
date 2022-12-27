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
include("../utils/getYears.php");


$getSingers = " SELECT * from singers";
$getAlbums = " SELECT * FROM album";
$getGenres = " SELECT * FROM genre";
$geLanguage = " SELECT * FROM language";

$result = mysqli_query($conn, $getSingers);
$singers = mysqli_fetch_all($result, MYSQLI_ASSOC);
$result = mysqli_query($conn, $getAlbums);
$albums = mysqli_fetch_all($result, MYSQLI_ASSOC);
$result = mysqli_query($conn, $getGenres);
$genres = mysqli_fetch_all($result, MYSQLI_ASSOC);
$result = mysqli_query($conn, $geLanguage);
$languages = mysqli_fetch_all($result, MYSQLI_ASSOC);

$errors = array('title' => '', 'mp3' => '', 'img' => '', 'singer' => '', 'genre' => '', 'language' => '', 'album' => '', 'year' => '');
$year = $album = $language = $genre = $singer = $title = $mp3 = $img = $singerID = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql2 = "SELECT * FROM songs WHERE id= '$id' ";
    $res2 = mysqli_query($conn, $sql2);
    $data = mysqli_fetch_array($res2);
    $title = $data["title"];
    $selectedSinger = $data["singerID"];
    $selectedAlbum = $data["albumID"];
    $selectedLanguage = $data["languageID"];
    $selectedGenre = $data["genereID"];
    $selectedYear = $data["year"];
}

// Save file to sv
function saveFile($fileInfo)
{
    $filename = $fileInfo['name'];
    $type = $fileInfo['type'];
    $folder = (strpos($type, "image") !== false) ? 'images/' : 'video/';

    $tmpPath = $fileInfo['tmp_name'];
    $destinationPath = $folder . $filename;
    print($destinationPath);
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
    } else if(empty($_POST['singer'])) {
        $errors['singer'] = "Singer cannot be empty";
    } else if(empty($_POST['album'])) {
        $errors['album'] = "Album cannot be empty";
    } else if(empty($_POST['genre'])) {
        $errors['genre'] = "Genre cannot be empty";
    } else if(empty($_POST['language'])) {
        $errors['language'] = "Language cannot be empty";
    } else if(empty($_POST['year'])) {
        $errors['year'] = "Year cannot be empty";
    }
    else {
        $title = $_POST['title'];
        $singerID = $_POST['singer'];
        $albumID = $_POST['album'];
        $genreID = $_POST['genre'];
        $languageID = $_POST['language'];
        $year = $_POST['year'];
    }

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
            $insertSong = "INSERT INTO songs(title, filePath, imgPath, singerID, fileType, languageID, genereID, albumID, year) 
                             VALUES ('$title', '$mp3Path', '$imgPath', $singerID, 'audio', $languageID, $genreID, $albumID, '$year')";
            if (!mysqli_query($conn, $insertSong)) {
                echo  "Error: " . "<br>" . mysqli_error($conn);
            } else {
                echo "<script type='text/javascript'>document.location.href='editSong.php';</script>";
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
    <h3 class="notice">UPLOAD Video SONGS</h3>
    <form class="form-insert" method="POST" enctype="multipart/form-data">
        <?php foreach ($errors as $error) : ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endforeach; ?>
        <div class="row form-group align-items-center">
            <div class="col-md-3">
                <label class="form-label">Title</label>
            </div>
            <div class="col-md-9">
                <input class="form-control" type="text" name="title" placeholder="Song name" value="<?php echo $title; ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label for="Singer" class="form-label">Singer</label>
            </div>
            <div class="col-md-9">

                <select name="singer" class="col-md-5">
                    <?php foreach ($singers as $singer) : ?>
                        <option value='<?php echo $singer['id'] ?>' <?php if ($singer['id'] === $selectedSinger) : ?> selected="selected" <?php endif; ?>>
                            <?php echo $singer['name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

        </div>
        <div class="row">
            <div class="col-md-3">
                <label for="Singer" class="form-label">Album</label>
            </div>
            <div class="col-md-9">

                <select name="album" class="col-md-5">
                    <?php foreach ($albums as $album) : ?>
                        <option value='<?php echo $album['id'] ?>' <?php if ($album['id'] === $selectedAlbum) : ?> selected="selected" <?php endif; ?>>
                            <?php echo $album['title']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

        </div>
        
        
        <div class="row">
            <div class="col-md-3">
            <label for="genre" class="form-label">Genre</label>
            </div>
            <div class="col-md-9">
                
            <select name="genre">
                <?php foreach ($genres as $genre) : ?>
                    <option value='<?php echo $genre['id'] ?>' <?php if ($genre['id'] === $selectedGenre) : ?> selected="selected" <?php endif; ?>>
                        <?php echo $genre['title']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            </div>
            
        </div>
        <div class="row">
            <div class="col-md-3">
                <label for="Singer" class="form-label">Language</label>
            </div>
            <div class="col-md-9">

                <select name="language" class="col-md-5">
                    <?php foreach ($languages as $language) : ?>
                        <option value='<?php echo $language['id'] ?>' <?php if ($language['id'] === $selectedLanguage) : ?> selected="selected" <?php endif; ?>>
                            <?php echo $language['title']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

        </div>
        <div class="row">
            <div class="col-md-3">
                <label for="Singer" class="form-label">Year</label>
            </div>
            <div class="col-md-9">
                <select name="year" class="col-md-5">
                    <?php foreach ($years as $year) : ?>
                        <option value='<?php echo $year;?>' <?php if ($year == $selectedYear) : ?> selected="selected" <?php endif; ?> >
                            <?php echo $year; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

        </div>

        <div class="row">
            <div class="col-md-3">
            <label class="form-label">MP4 File</label>
            </div>
            <div class="col-md-9">
            <input class="form-control" type="file" name="mp3" accept="video/*">
                    </div>           
           
        </div>

        <div class="row">
            <div class="col-md-3">
            <label class="form-label">Images</label>
            </div>
            <div class="col-md-9">
            <input class="form-control" type="file" name="image" accept="image/*">
            </div>            
            
        </div>
        <div class="mb-3">
            <a href="editSong.php" class="ca">BACK</a>
            <button type="submit" name="submit">SUBMIT</button>
        </div>
    </form>
</body>
<!-- <script>
    var image = tags.picture;
    if (image) {
        var base64String = "";
        for (var i = 0; i < image.data.length; i++) {
            base64String += String.fromCharCode(image.data[i]);
        }
        var base64 = "data:" + image.format + ";base64," +
            window.btoa(base64String);
        document.getElementById('picture').setAttribute('src', base64);
    } else {
        document.getElementById('picture').style.display = "none";
    }
</script> -->

</html>