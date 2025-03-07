<?php
session_start();

include "../settings/connection.php";

ini_set('display_errors', 1);
error_reporting(E_ALL);

function fetchStatistics($connection) {
    $statistics = array();
    $query_found_items = "SELECT COUNT(*) AS found_items_count FROM found_items";
    $result_found_items = mysqli_query($connection, $query_found_items);
    $row_found_items = mysqli_fetch_assoc($result_found_items);
    $statistics['found_items'] = $row_found_items['found_items_count'];

    $query_lost_items = "SELECT COUNT(*) AS lost_items_count FROM lost_items";
    $result_lost_items = mysqli_query($connection, $query_lost_items);
    $row_lost_items = mysqli_fetch_assoc($result_lost_items);
    $statistics['lost_items'] = $row_lost_items['lost_items_count'];

    $query_claimed_items = "SELECT COUNT(*) AS claimed_items_count FROM claimed_items";
    $result_claimed_items = mysqli_query($connection, $query_claimed_items);
    $row_claimed_items = mysqli_fetch_assoc($result_claimed_items);
    $statistics['claimed_items'] = $row_claimed_items['claimed_items_count'];

    return $statistics;
}

$statistics = fetchStatistics($conn);

echo json_encode($statistics);




mysqli_close($conn);
?>
