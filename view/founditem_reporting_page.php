<?php
include "../settings/core.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/reporting_page.css">
    <title>Report Found Item</title>
    <style>
        i {
    margin-right: 10px;
}


    </style>
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
    <div class="form-container">
        <div class="form-header"><b>Report a Found Item</b></div>
        <form action="../actions/item_found_action.php" method="POST" enctype="multipart/form-data">
            <?php
            if (isset($_GET['error'])) { ?>
                <p class="error" style="color:red"><?php echo $_GET['error'] ?></p>
            <?php } ?>
            <div class="form-field">
                <label style="color : rgb(28, 64, 46) " for="itemName">Item Name</label>
                <input type="text" id="itemName" name="itemName">

                <label style="color : rgb(28, 64, 46) " for="locationFound">Location Found</label>
                <input type="text" id="locationFound" name="locationFound">
                <div>
                    <label style="color: rgb(28, 64, 46); display: block;" for="dateFound">Date & Time Found</label>
                    <input type="date" id="date" name="date" style="width: 150px; display: inline-block;">
                    <input type="time" id="time" name="time" style="width: 120px; display: inline-block;">
                </div>

                <label style="color:rgb(28, 64, 46) " for="itemDescription">Item Description</label>
                <textarea id="itemDescription" name="itemDescription" rows="4"></textarea>
                <label style="color: rgb(28, 64, 46);" for="category">Category</label>
                <br>
                <select id="category" name="category" required>
                    <option value="Electronics">Electronics</option>
                    <option value="Books">Books</option>
                    <option value="Clothing">Clothing</option>
                    <option value="Others">Others</option>
                </select>
                <br>
                <br>
                <label style="color: rgb(28, 64, 46);" for="photo">Upload Photo</label>
                <input type="file" id="photo" name="photo">
            </div>
            <input type="submit" class="submit-button" name="submit_button" id="submit_button">
        </form>
    </div>
    <script src="https://kit.fontawesome.com/88061bebc5.js" crossorigin="anonymous"></script>

</body>

</html>