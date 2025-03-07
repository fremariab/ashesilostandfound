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

    <link rel="stylesheet" href="../css/items_display.css">
    <link rel="stylesheet" href="../css/user_dash_style.css">
    <title>claimed Items</title>
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
    <li id="searchclaimedItemsMenuItem" > 
        <a href="../view/item_claimed.php">
            <i class='bx bxs-report'></i>
            <span class="text">Search claimed Items</span>
        </a>
    </li>
    <li id="searchLostItemsMenuItem" >
        <a href="../view/item_lost.php">
            <i class='bx bxs-report'></i>
            <span class="text">Search Lost Items</span>
        </a>
    </li>
    <li id="reportclaimedItemMenuItem" >
        <a href="../view/claimeditem_reporting_page.php">
            <i class='bx bxs-report'></i>
            <span class="text">Report claimed Item</span>
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
                <a href="../login/logout.php" class="logout">
                    <i class='bx bxs-log-out-circle'></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    
        </div>

        <div class="items shifted-content">
            <h2>Items Claimed</h2>

            <form action="../actions/claimed_item_search.php" method="GET">
                <div class="form-input">
                <input type="search" name="keyword" placeholder="Search" style="width: calc(10% - 10px);float: right;">
                <button type="submit" class="search-btn" ><i class='bx bx-search'></i></button>
            </div>
            </form>
            <span>Items per page: 10</span>

            <form id="filterForm">
                <!-- Filtering Options -->
                <label for="item_type">Item Type:</label>
                <select name="item_type" id="item_type">
                    <option value="">All</option>
                    <option value="electronics">Electronics</option>
                    <option value="clothing">Clothing</option>
                    <option value="books">Books</option>
                    <option value="Others">Others</option>
                </select>

                <label for="location">Location:</label>
                <select name="location" id="location-select" onchange="toggleCustomLocationInput()">
                    <option value="">All</option>
                    <option value="cafeteria">Cafeteria</option>
                    <option value="library">Library</option>
                    <option value="research_building">Research Building</option>
                    <option value="nana_araba_apt_hall">Nana Araba Apt Hall</option>
                    <option value="hostels">Hostels</option>
                    <option value="other">Other</option>
                </select>
                <div class="form-input" id="custom-location-input" style="display: none;">
    <input type="text" id="custom-location" name="custom-location" placeholder="Enter custom location">
</div>

                <!-- Sorting Options -->
                <label for="sort-by">Sort By:</label>
                <select name="sort-by">
                    <option value="time_desc">Time (Newest First)</option>
                    <option value="time_asc">Time (Oldest First)</option>
                    <option value="name_asc">Name (A-Z)</option>
                    <option value="name_desc">Name (Z-A)</option>
                </select>

                <button type="button" id="apply-filters">Apply Filters & Sort</button>
            </form>

            <div class="items">

                <div class="lost">
                    <?php
                    include "../actions/retrieve_item_claimed.php";
                    ?>
                </div>
            </div>

            <!-- NEXT AND PREVIOUS BUTTON -->
            <div class="pages">
                <button id="prev-btn">Previous</button>
                <button id="next-btn">Next</button>
            </div>

        </div>
    </div>
<script src="../js/item_claimed.js"></script>
<script src="../js/item_page.js"></script>


</body>

</html>