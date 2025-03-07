<?php  
include "../settings/core.php"?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <title>Items Details</title>
    <link rel="stylesheet" href="../css/items_display.css">
 
</head>
<style>
         /* Previous and Next Buttons */
    .pages {
        position: relative;
        margin-top: 24px;
        display: flex;
        justify-content: space-between;
    }

    .pages button {
        padding: 10px 20px;
        border-radius: 10px;
        background: var(--blue);
        color: var(--light);
        border: none;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .pages button:hover {
        background: var(--light-orange);
    }

    #prev-btn {
        position: absolute;
        left: 0;
    }

    #next-btn {
        position: absolute;
        right: 0;
    }

    #sidebar {
    position: fixed;
    top: 0;
    left: 0;
    width: 250px;
    height: 100%;
    background-color: #fff;
    transition: left 0.3s ease;
    z-index: 1000; 
}

#sidebarToggle {
    position: fixed;
    top: 10px;
    left: 220px;
    z-index: 1001; 
}

.side-menu li {
    margin-bottom: 10px;
    margin-top: 10px;

}

/* #sidebar .side-menu li.active {
    background: var(--grey);
    position: relative;
} */

.shifted-sidebar #sidebarToggle {
    left: 220px;
}

.unshifted-sidebar #sidebarToggle {
    left: 10px;
}
.shifted-content {
    margin-left: 250px; 
    transition: margin-left 0.3s ease; 
}


</style>
<body>

    <div class="overall">
       <button id="sidebarToggle"><i class="material-icons">menu</i></button>

        <div id="sidebar">

        
        <a href="../view/user_dash.php" class="brand">
            <img src="../images/logo.png" height="64px" alt="">
        </a>
        <ul class="side-menu top">
    <li id="dashboardMenuItem" >
        <a href="../view/user_dash.php">
            <i class='bx bxs-dashboard'></i>
            <span class="text">Dashboard</span>
        </a>
    </li>
    <li id="searchFoundItemsMenuItem" > 
        <a href="../view/item_found.php">
            <i class='bx bxs-report'></i>
            <span class="text">Search Found Items</span>
        </a>
    </li>
    <li id="searchLostItemsMenuItem" >
        <a href="../view/item_lost.php">
            <i class='bx bxs-report'></i>
            <span class="text">Search Lost Items</span>
        </a>
    </li>
    <li id="reportFoundItemMenuItem" >
        <a href="../view/founditem_reporting_page.php">
            <i class='bx bxs-report'></i>
            <span class="text">Report Found Item</span>
        </a>
    </li>
    <li id="reportLostItemMenuItem" >
        <a href="../view/lostitem_reporting_page.php">
            <i class='bx bxs-report'></i>
            <span class="text">Report Lost Item</span>
        </a>
    </li>
</ul>

        <ul class="side-menu">
            <li>
                <a href="#">
                    <i class='bx bxs-user'></i>
                    <span class="text">Profile</span>
                </a>
            </li>
            <li>
                <a href="../login/logout_view.php" class="logout">
                    <i class='bx bxs-log-out-circle'></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    
        </div>


    <div class="items shifted-content">


        <h2 style="text-align: center;"> Item Details</h2>

        <span style="float: right;">Items per page: 15</span>

        <div class="lost">
            <?php
                include "../actions/display_found_item_details.php";

                // Check if the itemid parameter is set in the URL
                if (isset($_GET['itemid'])) {
                    $itemid = $_GET['itemid'];
                    // Call the getItemDetails function to fetch item details
                    $itemDetails = getItemDetails($conn, $itemid);

                    if (!empty($itemDetails)) {
                        // Display the details of the item
                        echo '<h2>Item Details</h2>';
                        echo '<img src="../uploads/' . $itemDetails['file_name'] . '" alt="Item Image" style="max-width: 300px;">'; // Display the image
                        echo '<p><strong>Item Name:</strong> ' . $itemDetails['item_name'] . '</p>';
                        echo '<p><strong>Description:</strong> ' . $itemDetails['description'] . '</p>';
                        echo '<p><strong>Interaction Time:</strong> ' . $itemDetails['interaction_time'] . '</p>';
                        echo '<p><strong>Location</strong> ' . $itemDetails['location'] . '</p>';
                        
                        echo '<p><strong>Category:</strong> ' . $itemDetails['category'] . '</p>';
                        echo '<p><strong>Status</strong> ' . $itemDetails['status'] . '</p>';
                        echo '<p><strong>Status</strong> ' . $itemDetails['status'] . '</p>';
                    } else {
                        echo '<p>No item found with the provided ID.</p>';
                    }
                } else {
                    echo '<p>Item ID is not provided.</p>';
                }
                mysqli_close($conn);
                ?>
        </div>
    </div>
<script src="../js/item_page.js"></script>
    <script src="../js/expand_item.js"></script>



</body>

</html>