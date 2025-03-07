<?php
 include "../settings/connection.php";

 $referrer = strtok($_SERVER['HTTP_REFERER'], '?');

  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $description = $_GET['description'];
    $location = $_GET['location'];
    $category = $_GET['category'];
    $status = $_GET['status'];
    $time = $_GET['time'];
    $itemid = $_GET['itemid'];
    $image_id = $_GET['imageid'];
    $rid = $_GET['rid'];
    $datee = $_GET['date'];
    $interaction_time = $_GET['interaction_time'];
    $uid = $_GET['uid'];
    $item_name = $_GET['item_name']; 

 
     if ($referrer==="http://18.133.105.236/findmy-ashesi/admin/view_item_detail_found.php"){
        $table_name = "found_items";
        $status = 3;  
    }    else if ($referrer==="http://18.133.105.236/findmy-ashesi/admin/view_item_detail_lost.php"){
        $table_name = "lost_items";
        $status = 3;  
    } else {
         exit("Invalid item type");
    }

    $sql = "DELETE FROM $table_name WHERE itemid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $itemid);
    $stmt->execute();
 
    $sql_claim = "INSERT INTO claimed_items (rid,  uid,image_id,time,location,description,category,datee,item_name) VALUES ('$rid', '$uid','$image_id','$time','$location','$description','$category','$datee','$item_name')";
    $result = mysqli_query($conn, $sql_claim);
     if ($result) {
        header("Location: ../admin/all_claimed_items.php");
        exit();
    } else {
        header("Location: ../admin/view_item_detail_found.php");
    }
    exit();
}
?>
