<?php include "../settings/core.php"?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Details</title>
    <link rel="stylesheet" href="../css/item_detail.css">

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
    <div class="lost">
            <?php
                include "../actions/display_lost_item_details.php";

                
                if (isset($_GET['itemid'])) {
                    $itemid = $_GET['itemid'];
                    
                    $itemDetails = getItemDetails($conn, $itemid);

                    if (!empty($itemDetails)) {
                       
                        echo '<h2>Item Details</h2>';
                        echo '<img src="../uploads/' . $itemDetails['file_name'] . '" alt="Item Image" style="max-width: 300px;">'; // Display the image
                        echo '<p><strong>Item Name:</strong> ' . $itemDetails['item_name'] . '</p>';
                        echo '<p><strong>Description:</strong> ' . $itemDetails['description'] . '</p>';
                        echo '<p><strong>Location</strong> ' . $itemDetails['location'] . '</p>';
                        echo '<p><strong>Category:</strong> ' . $itemDetails['category'] . '</p>';
                    }
                } else {
                    echo '<p>Item ID is not provided.</p>';
                }
                ?>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/88061bebc5.js" crossorigin="anonymous"></script>
    <script src="../js/expand_item.js"></script>
    <script src="../js/item_page.js"></script>
</body>

</html>