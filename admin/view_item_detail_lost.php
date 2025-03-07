<?php include "../settings/core.php";
include "../actions/send_email.php";
if ($_SESSION['user_role'] != 1)  {header("Location: ../view/user_dash.php");}
else{
?><!DOCTYPE html>
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
                        echo '<p><strong>Change Status:</strong> <a href="../actions/change_item_status_action.php?';
                        echo '&description=' . urlencode($itemDetails['description']);
                        echo '&location=' . urlencode($itemDetails['location']);
                        echo '&category=' . urlencode($itemDetails['category']);
                        echo '&status=' . urlencode($itemDetails['sid']);
                        echo '&itemid=' . urlencode($itemDetails['itemid']);
                        echo '&imageid=' . urlencode($itemDetails['image_id']);
                        echo '&rid=' . urlencode($itemDetails['rid']);
                        echo '&date=' . urlencode($itemDetails['datee']);
                        echo '&uid=' . urlencode($itemDetails['uid']);
                        echo '&time=' . urlencode($itemDetails['time']);
                        echo '&item_name=' . urlencode($itemDetails['item_name']);

                        echo '&interaction_time=' . urlencode($itemDetails['interaction_time']);
                        echo '" style="color:#1c402e"><i class="fa-solid fa-pen-to-square"></i></a></p>';  
                    } else {
                        echo '<p>No item found with the provided ID.</p>';
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

</html><?php }?>