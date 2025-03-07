<?php

include "../settings/connection.php";

if (isset($_GET["keyword"])) {
    $keyword = $_GET["keyword"];
    error_log("Keyword received: " . $keyword); 
    echo "Keyword received: " . $keyword;

    $query = "SELECT * FROM lost_items 
              WHERE item_name LIKE '%$keyword%' OR location LIKE '%$keyword%' OR description LIKE '%$keyword%'
              UNION
              SELECT * FROM found_items 
              WHERE item_name LIKE '%$keyword%' OR location LIKE '%$keyword%' OR description LIKE '%$keyword%'";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $searchResults = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $searchResults[] = $row;
        }

        mysqli_close($conn);
        echo "hmm";
        
        header("Location: ../view/search_results.php?results=" . urlencode(json_encode($searchResults)));
        exit();
    } else {
   
        // header("Location: ../view/search_result_page.php?results=none");

        exit();
    }
} else {

    // header("Location: ../view/search_result_page.php?results=none");
    exit();
}
?>
