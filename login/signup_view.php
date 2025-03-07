<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Signup</title>
    <link rel="stylesheet" href="../css/signup_style.css" />
</head>

<body>
    <div class="logo">
        <img src="../images/logo.png" alt="site logo" height="150px">
    </div>
    <div class="parent">
        <div class="container">
            <div class="registration form">
                <header>Signup</header>
                <form action="../actions/signup_action.php" method="post">
                    <?php
                    if (isset($_GET['userror'])) { ?>
                        <p class="error" style="color:red"><?php echo $_GET['error'] ?></p>
                    <?php } ?>
                    <input type="text" name="fname" id="fname" pattern="[A-Za-z]{2,50}" placeholder="First Name">

                    <input type="text" name="lname" id="lname" pattern="[A-Za-z]{2,50}" placeholder="Last Name">
                    <label style="color:gray;">Gender </label>

                    <div class="radio">
                        <div class="radio-container">
                            <input type="radio" name="gender" id="gender-male" value="1">
                            <label for="gender-male">Male</label>
                        </div>
                        <div class="radio-container">
                            <input type="radio" name="gender" id="gender-female" value="2">
                            <label for="gender-female">Female</label>
                        </div>
                    </div>
                    <?php
                    include "../settings/connection.php";

                    $sql = "SELECT * FROM role ORDER BY rid ASC";
                    $result = mysqli_query($conn, $sql);

                    if ($result->num_rows > 0) {
                        $options = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    }
                    ?>
                    <label style="color:gray;">Role </label>
                    <select name="user-role" id="user-role">
                        <?php
                        foreach ($options as $option) {
                            if ($option['rid'] != 1) {
                                echo " <option value='" . $option['rid'] . "'>" . $option['rname'] . "</option>";
                            }
                        }
                        ?>

                    </select>

                    <input type="text" name="phone_number" id="phone_number" pattern="^[+\d\s]+$" placeholder="Phone Number">

                    <input type="email" name="register_email" id="register_email" placeholder="Email">

                    <input type="password" name="register_password" id="register_password" placeholder="Password">

                    <input type="password" name="register_password1" id="register_password1" placeholder="Confirm Password">

                    <input type="submit" class="button" name="submit_button" id="submit_button">

                </form>
                <div class="signup">
                    <span class="signup">Already have an account?
                        <label for="check" style="color:#1C402E;"><a href="../login/login_view.php">Login</a></label>
                    </span>
                </div>
            </div>
        </div>
    </div>

</body>

</html>