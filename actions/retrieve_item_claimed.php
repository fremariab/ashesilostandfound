<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include "../settings/connection.php";

function getclaimedItems($connection, $limit, $offset, $sortBy, $itemType, $location) {
    $sql = "SELECT c.*, i.file_name 
    FROM claimed_items c
    INNER JOIN image i ON c.image_id = i.image_id";

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


    $claimedItems = array();
    while ($row = $result->fetch_assoc()) {
        $claimedItems[] = $row;
    }

    $result->free();

    return $claimedItems;
}


$sortBy = isset($_GET['sort-by']) ? $_GET['sort-by'] : '';

$itemType = isset($_GET['item_type']) ? $_GET['item_type'] : '';

$location = isset($_GET['location']) ? $_GET['location'] : '';

// Define limit and offset for pagination
$limit = 10; // Change this to the number of items you want to display per page
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($current_page - 1) * $limit;

// Retrieve claimed items with sorting, filtering, and pagination
$claimedItems = getclaimedItems($conn, $limit, $offset, $sortBy, $itemType, $location);

// Encode the claimed items as JSON and echo the result
echo json_encode($claimedItems);
?>
