<?php include "../settings/core.php";
include "../actions/send_email.php";
include "../actions/get_user_data.php";

if ($_SESSION['user_role'] != 1)  {header("Location: ../view/user_dash.php");}
else{?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator Profile</title>
    <link rel="stylesheet" href="../css/profile.css">

</head>

<body>
    <div class="sidebar">
        <div class="sidebar_logo">
            <a href="../admin/admin_dash.php">
                <img id="logo" src="../images/logo.png"> </a>
        </div>
        <div class="menu_top">
            <a href="../admin/admin_dash.php"><i class="fa-solid fa-house"></i>Dashboard</a>
            <a href="../admin/all_lost_items.php"> <i class="fa-solid fa-magnifying-glass"></i> All Lost Items</a>
            <a href="../admin/all_found_items.php"><i class="fa-solid fa-check"></i> All Found Items</a>
            <a href=" ../admin/all_claimed_items.php"><i class="fa-solid fa-right-left"></i> All Claimed Items</a>
            <a href="<?php echo $mailto_link; ?>"><i class="fa-solid fa-envelope"></i> Send Weekly Mail</a>
            <a href="#" style="margin-top: 30px;">
                ---------------------
            </a>
            <a href="../admin/admin_profile.php"><i class="fa-solid fa-user"></i> Profile</a>
            <a href="../login/logout_view.php" style="margin-right: 100px;"> <i
                    class="fas fa-sign-out-alt"></i>Logout</a>
        </div>
    </div>
    <div class="content">
    <header class="header">
            <h1>Admin Profile</h1>
        </header>
            <p><strong>First Name:</strong> <?php echo $userData['fname']; ?></p>
            <p><strong>Last Name:</strong> <?php echo $userData['lname']; ?></p>
            <p><strong>Gender:</strong> <?php echo ($userData['gender'] == 1) ? 'Male' : 'Female'; ?></p>
            <p><strong>Telephone:</strong> <?php echo $userData['tel']; ?></p>
            <p><strong>Email:</strong> <?php echo $userData['email']; ?></p>
    </div>
    <script src="https://kit.fontawesome.com/88061bebc5.js" crossorigin="anonymous"></script>
</body>
</html><?php }?>