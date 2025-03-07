<?php include "../settings/core.php";

include "../actions/get_user_data.php"?><!DOCTYPE html>
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
            <a href="../view/user_dash.php">
                <img id="logo" src="../images/logo.png"> </a>
        </div>
        <div class="menu_top">
            <a href="../view/user_dash.php"><i class="fa-solid fa-house"></i>Dashboard</a>
            <a href="../view/item_lost.php"> <i class="fa-solid fa-magnifying-glass"></i> Search Lost Items</a>
            <a href="../view/item_found.php"><i class="fa-solid fa-check"></i> Search Found Items</a>
            <a href="../view/founditem_reporting_page.php"><i class="fa-solid fa-align-justify"></i> Report Found Item</a>
            <a href="../view/lostitem_reporting_page.php"><i class="fa-solid fa-align-justify"></i> Report Lost Item</a>
            <a href="#" style="margin-top: 30px;">
                ---------------------
            </a>
            <a href="../view/user_profile.php"><i class="fa-solid fa-user"></i> Profile</a>
            <a href="../login/logout_view.php" style="margin-right: 100px;"> <i
                    class="fas fa-sign-out-alt"></i>Logout</a>
        </div>
    </div>
    <div class="content">
    <header class="header">
            <h1>User Profile</h1>
        </header>
            <p><strong>First Name:</strong> <?php echo $userData['fname']; ?></p>
            <p><strong>Last Name:</strong> <?php echo $userData['lname']; ?></p>
            <p><strong>Gender:</strong> <?php echo ($userData['gender'] == 1) ? 'Male' : 'Female'; ?></p>
            <p><strong>Telephone:</strong> <?php echo $userData['tel']; ?></p>
            <p><strong>Email:</strong> <?php echo $userData['email']; ?></p>
    </div>
    <script src="https://kit.fontawesome.com/88061bebc5.js" crossorigin="anonymous"></script>
</body>
</html>