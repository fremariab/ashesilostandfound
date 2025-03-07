<?php  
include "../settings/core.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="../css/items_display.css">
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
            <h1>Search Results Found</h1>
        </header>
        <div class="search-results">
               <!-- Pagination Logic -->
 <?php
       if (isset($_GET["results"]) && isset($_GET["total_rows"])) {
           $searchResults = json_decode($_GET["results"], true);
           $total_rows = $_GET["total_rows"];

           if (!empty($searchResults)) {
               $records_per_page = 2; 
               $total_pages = ceil($total_rows / $records_per_page);
               $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

               // Slice search results for pagination
               $start = ($current_page - 1) * $records_per_page;
               $end = $start + $records_per_page;
               $searchResults = array_slice($searchResults, $start, $records_per_page);

               foreach ($searchResults as $result) {
                   echo "<div class='item'>";
                   echo "<h3><a href='../view/items_details_lost.php?itemid=" . $result["itemid"] . "'>" . $result["item_name"] . "</a></h3>";
                   echo "<p>Location: " . $result["location"] . "</p>";
                   echo "<p>Description: " . $result["description"] . "</p>";
                   echo "</div>";
               }

               // pagination controls
               echo "<div class='pages'>";
               if ($current_page > 1) {
                   echo "<a href='lost_item_search_result.php?page=" . ($current_page - 1) . "&results=" . urlencode($_GET['results']) . "&total_rows=" . $total_rows . "'><button id='prev-btn'>Previous</button></a>";
               }
               if ($current_page < $total_pages) {
                   echo "<a href='lost_item_search_result.php?page=" . ($current_page + 1) . "&results=" . urlencode($_GET['results']) . "&total_rows=" . $total_rows . "'><button id='next-btn'>Next</button></a>";
               }
               echo "</div>";
           } else {
               echo "<p>No matching items found.</p>";
           }
       } else {
           echo "<p>No search results available.</p>";
       }
       ?>   </div>
        </div>
    
    </div>

    <script src="https://kit.fontawesome.com/88061bebc5.js" crossorigin="anonymous"></script>
    <script src="../js/item_page.js"></script>
    <script>
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "../actions/user_dash_stats.php", true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log("Yes")
                var statistics = JSON.parse(xhr.responseText);
                console.log("Statistics:", statistics);

                document.getElementById("found-items-count").textContent = statistics.found_items;
                document.getElementById("lost-items-count").textContent = statistics.lost_items;
                document.getElementById("claimed-items-count").textContent = statistics.claimed_items;
            }
        };
        xhr.send();

        var currentPage = 1;

        function loadNextPage() {
            currentPage++;
            loadData(currentPage);
        }

        function loadPreviousPage() {
            if (currentPage > 1) {
                currentPage--;
                loadData(currentPage);
            }
        }

        function loadData(page) {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "../actions/user_dash_activities.php?page=" + page, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var tableBody = document.getElementById("activity-table-body");
                    tableBody.innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }
    </script>
</body>

</html>