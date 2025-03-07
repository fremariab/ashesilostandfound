<?php
session_start();

include "../settings/connection.php";

ini_set('display_errors', 1);
error_reporting(E_ALL);

function fetchUserStatistics($connection, $user_id) {
    $statistics = array();

    // fetch count of found items for the user
    $query_found_items = "SELECT COUNT(*) AS found_items_count FROM found_items WHERE uid = $user_id";
    $result_found_items = mysqli_query($connection, $query_found_items);
    $row_found_items = mysqli_fetch_assoc($result_found_items);
    $statistics['found_items'] = $row_found_items['found_items_count'];

    //fetch count of lost items for the user
    $query_lost_items = "SELECT COUNT(*) AS lost_items_count FROM lost_items WHERE uid = $user_id";
    $result_lost_items = mysqli_query($connection, $query_lost_items);
    $row_lost_items = mysqli_fetch_assoc($result_lost_items);
    $statistics['lost_items'] = $row_lost_items['lost_items_count'];

    //fetch count of claimed items for the user
    $query_claimed_items = "SELECT COUNT(*) AS claimed_items_count FROM claimed_items WHERE uid = $user_id";
    $result_claimed_items = mysqli_query($connection, $query_claimed_items);
    $row_claimed_items = mysqli_fetch_assoc($result_claimed_items);
    $statistics['claimed_items'] = $row_claimed_items['claimed_items_count'];

    return $statistics;
}

// Check if user_id is set in the session
if (isset($_SESSION['user_id'])) {
   
    $user_id = $_SESSION['user_id'];

    $statistics = fetchUserStatistics($conn, $user_id);

    echo json_encode($statistics);
} else {

    echo json_encode(['error' => 'User not logged in']);
}

mysqli_close($conn);
?>