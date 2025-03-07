<?php

include "../settings/connection.php";

if (isset($_GET["keyword"])) {
    $keyword = $_GET["keyword"];

    $query = "SELECT * FROM lost_items 
              WHERE item_name LIKE '%$keyword%' OR location LIKE '%$keyword%' OR description LIKE '%$keyword%'";

    $result = mysqli_query($conn, $query);


    if ($result) {
        $total_rows = mysqli_num_rows($result);

        if ($total_rows > 0) {
            $searchResults = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $searchResults[] = $row;
            }

            mysqli_free_result($result);
            mysqli_close($conn);

            $redirectURL = "../view/lost_item_search_result.php?page=1&results=" . urlencode(json_encode($searchResults)) . "&total_rows=" . $total_rows;
            header("Location: $redirectURL");
            exit();
        } else {
            mysqli_close($conn);
            $redirectURL = "../view/lost_item_search_result.php?page=1&results=none";
            header("Location: $redirectURL");
            exit();
        }
    } else {
        echo "Error executing query: " . mysqli_error($conn);
        exit();
    }
} else {
    $redirectURL = "../view/lost_item_search_result.php?page=1&results=none";
    header("Location: $redirectURL");
    exit();
}
?>
