<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "../settings/connection.php";

function getFoundItems($connection, $limit, $offset, $sortBy, $itemType, $location) {
    $sql = "SELECT f.*, i.file_name, s.sname
            FROM found_items f 
            INNER JOIN image i ON f.image_id = i.image_id
            INNER JOIN found_status s ON f.sid = s.sid WHERE 1=1";

    
    if (!empty($itemType)) {
        $sql .= " AND category = '$itemType'";
    }

    
    if (!empty($location)) {
        if ($location === 'other') { 
            if (!empty($_GET['custom-location'])) {
                $customLocation = $connection->real_escape_string($_GET['custom-location']);
                // echo "Custom Location: " . $customLocation;
                $sql .= " OR location LIKE '%$customLocation%'";
                // echo "sql " . $sql;
            }
        } else {
            $sql .= " OR location = '$location'";
            // echo "sql " . $sql;
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


    $foundItems = array();
    while ($row = $result->fetch_assoc()) {
        $foundItems[] = $row;
    }

    $result->free();

    return $foundItems;
}


$sortBy = isset($_GET['sort-by']) ? $_GET['sort-by'] : '';

$itemType = isset($_GET['item_type']) ? $_GET['item_type'] : '';

$location = isset($_GET['location']) ? $_GET['location'] : '';

// Define limit and offset for pagination
$limit = 10; 
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($current_page - 1) * $limit;

// Retrieve found items with sorting, filtering, and pagination
$foundItems = getFoundItems($conn, $limit, $offset, $sortBy, $itemType, $location);


echo json_encode($foundItems);
?>
