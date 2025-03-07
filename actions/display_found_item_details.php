<?php

include "../settings/connection.php";


function getItemDetails($conn, $itemid) {
    $itemDetails = array();

    $itemid = mysqli_real_escape_string($conn, $itemid);

    $sql = "SELECT f.*, i.file_name, s.sname
            FROM found_items f 
            INNER JOIN image i ON f.image_id = i.image_id
            INNER JOIN found_status s ON f.sid = s.sid
            WHERE f.itemid = $itemid";
    $result = mysqli_query($conn, $sql);

    if($result && mysqli_num_rows($result) > 0) {
        // Fetch the details of the item
        $item = mysqli_fetch_assoc($result);

        // Assign the item details to the array
        $itemDetails['item_name'] = $item['item_name'];
        $itemDetails['file_name'] = $item['file_name'];
        $itemDetails['category'] = $item['category'];
        $itemDetails['description'] = $item['description'];
        $itemDetails['interaction_time'] = $item['interaction_time'];
        $itemDetails['location'] = $item['location'];
        $itemDetails['itemid'] = $item['itemid'];
        $itemDetails['image_id'] = $item['image_id'];
        $itemDetails['sid'] = $item['sid'];
        $itemDetails['rid'] = $item['rid'];
        $itemDetails['datee'] = $item['datee'];
        $itemDetails['time'] = $item['time'];
        $itemDetails['uid'] = $item['uid'];

        
    }

  
    mysqli_close($conn);

    return $itemDetails;
}
?>
