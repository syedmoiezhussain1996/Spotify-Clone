<?php
include("../utils/dbConnection.php");
include('./auth.php');

if (!$authenticated) {
    header("Location: ./login.php");
} else {
    if (!$admin) {
        header("Location: ./unauth.php");
    } else {
        $id = $_GET['id'];

        $sql = "DELETE FROM genre WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);
        if ($result) header("Location: editGenre.php");
    }
}
