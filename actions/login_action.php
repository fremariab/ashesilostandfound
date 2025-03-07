<?php session_start();
include "../settings/connection.php";

if (isset($_POST['submit_button'])) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $user_mail = validate($_POST['email']);
    $psswrd = validate($_POST['passwrd']);

    if (empty($user_mail)) {
        header("Location: ../login/login_view.php?error=Email is required");
        exit();
    } else if (empty($psswrd)) {
        header("Location: ../login/login_view.php?error=Password is required");
        exit();
    }

    $sql = "SELECT * FROM user where email='$user_mail'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        // verify the password here ===> password_verify($password, $hash from the db)
        if (password_verify($psswrd, $row['passwd'])) {
            $_SESSION['user_id'] = $row['uid'];
            $_SESSION['user_role'] = $row['rid'];
            if ($_SESSION['user_role'] !=1) {
                header("Location: ../view/user_dash.php");

                exit();
            } else {
                header("Location: ../admin/admin_dash.php");

                exit();
            }
        } else {
            header("Location: ../login/login_view.php?error=Incorrect password.");
            exit();
        }
    } else {
        header("Location: ../login/login_view.php?error=Email is not registered.");
        exit();
    }
}
