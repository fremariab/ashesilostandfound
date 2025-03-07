<?php
include "../settings/connection.php";
if (isset($_SESSION['user_id'])) {

    $uid = $_SESSION['user_id'];

    $sql = "SELECT * FROM `user` WHERE `uid` = '$uid'";
    $result = mysqli_query($conn, $sql); 

    $userData = mysqli_fetch_assoc($result);

} else {
    header("Location: ../login/login_view.php");
    exit();
}