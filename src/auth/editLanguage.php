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
$sql = "SELECT * FROM language";
$result = mysqli_query($conn, $sql);
$languages = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genre</title>
    <link rel="stylesheet" href="./css/editSinger.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="container">
        <div class="link">
            <a class="ca2" href="adminDashboard.php">BACK</a>
        </div>

        <table id="customers" align="center" border="1" style="border-color: #fff;" class="displayLanguage">
            <tr>
                <th colspan="5">LANGUAGE INFO</th>
            </tr>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th colspan="3">Operations</th>
            </tr>


            <?php foreach ($languages as $index => $language) : if ($index == 5) break; ?>
                <tr>
                    <td><?php echo $index + 1; ?></td>
                    <td><?php echo $language['title']; ?></td>
                    <td><a style="padding: 5px; background-color: #66FF33; color: #fff; border-radius: 15px; text-decoration: none;" href="insertLanguage.php?id=<?php echo $language['id'] ?>"><strong>Update</strong></a></td>
                    <td><a style="padding: 5px; background-color: #E3242B; color: #fff; border-radius: 15px; text-decoration: none;" href="deleteLanguage.php?id=<?php echo $language['id'] ?>"><strong>Delete</strong></a></td>
                </tr>
            <?php endforeach; ?>

        </table>
        <div class="c3"><a href=insertLanguage.php>INSERT LANGUAGE</a></div>
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
            <th colspan="5">LANGUAGE INFO</th>
        </tr>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th colspan="3">Operations</th>
        </tr>`
        let displayLanguage = document.getElementsByClassName("displayLanguage")[0];
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let results = JSON.parse(this.responseText);
                let html = '';
                displayLanguage.innerHTML = header;
                results.map((value, index) => {
                    html +=
                        ` <tr>
                    <td> ${index + 1}</td>
                    <td>${value['title']}</td>
                    <td><a style="padding: 5px; background-color: #66FF33; color: #fff; border-radius: 15px; text-decoration: none;" href="insertLanguage.php?id=${value['id']}">Update</a></td>
                    <td><a style="padding: 5px; background-color: #E3242B; color: #fff; border-radius: 15px; text-decoration: none;" href="deleteLanguage.php?id=${value['id']}">Delete</a></td>
                    </tr>`
                })
                displayLanguage.innerHTML += html;
            }
        };
        xhttp.open("GET", "paginationLanguage.php?page=" + value, true);
        xhttp.send();
    }
</script>

</html>