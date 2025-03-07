<?php session_start();
include "../settings/connection.php";

if (isset($_POST['submit_button'])) {
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $register_email = mysqli_real_escape_string($conn, $_POST['register_email']);
    $register_password = mysqli_real_escape_string($conn, $_POST['register_password']);
    $register_password1 = mysqli_real_escape_string($conn, $_POST['register_password1']);


    if (empty($fname)) {
        header("Location: ../login/signup_view.php?error=First Name is required");
        exit();
    } else if (empty($lname)) {
        header("Location: ../login/signup_view.php?error=Last Name is required");
        exit();
    } else if (empty($phone_number)) {
        header("Location: ../login/signup_view.php?error=Phone number is required");
        exit();
    } else if (empty($register_email)) {
        header("Location: ../login/signup_view.php?error=Email is required");
        exit();
    } else if (empty($register_password)) {
        header("Location: ../login/signup_view.php?error=Password is required");
        exit();
    } else if (empty($register_password1)) {
        header("Location: ../login/signup_view.php?error=Confirm Password is required");
        exit();
    }

    if (!(isset($_POST['gender']))) {
        header("Location: ../login/signup_view.php?error=No radio button was selected.");
        exit();
    } else {
        $gender = $_POST["gender"];
    }

    if (isset($_POST["user-role"])) {
        $rid = $_POST["user-role"];
    } else {
        header("Location: ../login/signup_view.php?error=Please select a role.");
        exit();
    }

    $sql = "Select * from user where email='$register_email'";
    $result = mysqli_query($conn, $sql);
    $count_email = mysqli_num_rows($result);

    if ($count_email == 0) {

        if ($register_password == $register_password1) {

            $hash = password_hash($register_password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO user(rid,fname, lname, gender,tel,email,passwd) VALUES('$rid','$fname' ,'$lname','$gender', '$phone_number','$register_email','$hash')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                header("Location: ../login/login_view.php");
            }
        } else {
            header("Location: ../login/signup_view.php?error=Incorrect password.");
        }
    } else {
        if ($count_email > 0) {
            header("Location: ../login/signup_view.php?error=This user already exists");
        }
    }
}
