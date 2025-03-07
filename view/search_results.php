<?php  
include "../settings/core.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="../css/items_display.css">
    <link rel="stylesheet" href="../css/user_dash_style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
    z-index: 1001; 
}

.side-menu li {
    margin-bottom: 10px;
    margin-top: 10px;

}
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
                <li class="active">
                    <a href="#">
                        <i class='bx bxs-dashboard'></i>
                        <span class="text">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="../view/item_found.php">
                        <i class='bx bxs-report'></i>
                        <span class="text">Search Found Items</span>
                    </a>
                </li>
                <li>
                    <a href="../view/item_lost.php">
                        <i class='bx bxs-report'></i>
                        <span class="text">Search Lost Items</span>
                    </a>
                </li>
                <li>
                    <a href="../view/founditem_reporting_page.php">
                        <i class='bx bxs-report'></i>
                        <span class="text">Report Found Item</span>
                    </a>
                </li>
                <li>
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

        <!-- Content Area -->
        <div class="items shifted-content">
            <h1>Search Results</h1>
            <div class="search-results">
                <?php
                if (isset($_GET["results"])) {
                    $searchResults = json_decode(urldecode($_GET["results"]), true);
                    if ($searchResults && !empty($searchResults)) {
                        foreach ($searchResults as $result) {
                            echo "<div class='item'>";
                            echo "<h3>Item Name: " . $result["item_name"] . "</h3>";
                            echo "<p>Location: " . $result["location"] . "</p>";
                            echo "<p>Description: " . $result["description"] . "</p>";
                            echo "</div>";
                        }
                    } else {
                        echo "<p>No matching items found.</p>";
                    }
                } else {
                    echo "<p>No search results available.</p>";
                }
                ?>
            </div>
        </div>
    </div>
    <script>
document.addEventListener("DOMContentLoaded", function() {
    const sidebar = document.getElementById("sidebar");
    const sidebarToggle = document.getElementById("sidebarToggle");
    const content = document.querySelector(".items");

    sidebar.style.left = "0px"; 
    content.classList.add("shifted-content"); 
    sidebar.classList.add("shifted-sidebar"); 
    sidebarToggle.classList.add("shifted-sidebar");

    
    function toggleSidebar() {
        if (sidebar.style.left === "0px") {
            sidebar.style.left = "-250px";
            content.classList.remove("shifted-content");
            sidebar.classList.remove("shifted-sidebar");
            sidebarToggle.classList.remove("shifted-sidebar");
        } else {
            sidebar.style.left = "0px";
           content.classList.add("shifted-content");
            sidebar.classList.add("shifted-sidebar");
            sidebarToggle.classList.add("shifted-sidebar");
        }
    }

    
    sidebarToggle.addEventListener("click", toggleSidebar);
});



</script>
</body>
</html>
