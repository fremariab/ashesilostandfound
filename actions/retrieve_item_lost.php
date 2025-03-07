<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// session_start();
include "../settings/connection.php";

function getLostItems($connection, $limit, $offset, $sortBy, $itemType, $location) {
    $sql = "SELECT l.*, i.file_name, s.sname
    FROM lost_items l 
    INNER JOIN image i ON l.image_id = i.image_id
    INNER JOIN lost_status s ON l.sid = s.sid WHERE 1=1";

    
    if (!empty($itemType)) {
        $sql .= " AND category = '$itemType'";
    }

    
    if (!empty($location)) {
        if ($location === 'other') { 
            if (!empty($_GET['custom-location'])) {
                $customLocation = $connection->real_escape_string($_GET['custom-location']);
                $sql .= " OR location LIKE '%$customLocation%'";
                
            }
        } else {
            $sql .= " OR location = '$location'";
        }
    }

    switch ($sortBy) {
        case 'time_asc':
            $sql .= " ORDER BY interaction_time ASC";
            break;
        case 'time_desc':
            $sql .= " ORDER BY interaction_time DESC";
            break;
        case 'name_asc':
            $sql .= " ORDER BY item_name ASC";
            break;
        case 'name_desc':
            $sql .= " ORDER BY item_name DESC";
            break;
        default:
            $sql .= " ORDER BY interaction_time DESC";
            break;
    }


    $sql .= " LIMIT $limit OFFSET $offset";


    $result = $connection->query($sql);

    if ($result === false) {
        echo "Error: " . $connection->error;
        return array();
    }


    $lostItems = array();
    while ($row = $result->fetch_assoc()) {
        $lostItems[] = $row;
    }

    $result->free();

    return $lostItems;
}


$sortBy = isset($_GET['sort-by']) ? $_GET['sort-by'] : '';

$itemType = isset($_GET['item_type']) ? $_GET['item_type'] : '';

$location = isset($_GET['location']) ? $_GET['location'] : '';

// Define limit and offset for pagination
$limit = 10; // Change this to the number of items you want to display per page
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($current_page - 1) * $limit;

// Retrieve found items with sorting, filtering, and pagination
$lostItems = getLostItems($conn, $limit, $offset, $sortBy, $itemType, $location);

// Encode the found items as JSON and echo the result
echo json_encode($lostItems);
?>
