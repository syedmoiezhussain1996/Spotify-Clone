<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Category</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <form method="POST" enctype="multipart/form-data">
        <h2>Categories</h2>

        <label>Album Name</label>
        <input type="text" name="albumname" placeholder="Album name" value="<?php echo $name; ?>"><br>
        <label>YEAR</label>
        <input type="text" name="albumname" placeholder="Year" value="<?php echo $year; ?>"><br>
        <label>ARTIST</label>
        <select name="singer">
            <option></option>
        </select><br />

        <a href="adminDashboard.php" class="ca">BACK</a>

        <button type="submit" name="submit">SUBMIT</button>
    </form>
</body>

</html>