<?php
session_start();

include "../settings/connection.php";

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Check if the form has been submitted
if (isset($_GET['apply_filters'])) {
    // Get the selected filter options
    $item_type = isset($_GET['item_type']) ? $_GET['item_type'] : '';
    $location = isset($_GET['location']) ? $_GET['location'] : '';
    $sort_by = isset($_GET['sort-by']) ? $_GET['sort-by'] : '';

    // Build the WHERE clause for filtering
    $where_clause = '';
    if (!empty($item_type)) {
        $where_clause .= " AND category = '$item_type'";
    }
    if (!empty($location)) {
        $where_clause .= " AND location = '$location'";
    }

    // Build the ORDER BY clause for sorting
    switch ($sort_by) {
        case 'time_asc':
            $order_by_clause = " ORDER BY time ASC";
            break;
        case 'time_desc':
            $order_by_clause = " ORDER BY time DESC";
            break;
        case 'name_asc':
            $order_by_clause = " ORDER BY item_name ASC";
            break;
        case 'name_desc':
            $order_by_clause = " ORDER BY item_name DESC";
            break;
        default:
            $order_by_clause = ""; // No sorting applied
    }

    // Construct the SQL query with filtering and sorting
    $query = "SELECT * FROM lost_items WHERE 1=1 $where_clause
              UNION
              SELECT * FROM found_items WHERE 1=1 $where_clause
              $order_by_clause";

    // Execute the query and display the results
    // (You need to implement this part based on your application's requirements)
    // mysqli_query() or PDO::query() would be used here
}
?>

