<?php
session_start();

include "../settings/connection.php";

if (isset($_POST['submit_button'])) {
    $itemName = mysqli_real_escape_string($conn, $_POST['itemName']);
    $locationLost = mysqli_real_escape_string($conn, $_POST['locationLost']);
    $itemDescription = mysqli_real_escape_string($conn, $_POST['itemDescription']);
    $userrole = $_SESSION['user_role'];
    $userid = $_SESSION['user_id'];
    $time = $_POST['time'];
    $date = $_POST['date'];

    if ($_FILES['photo']['size'] == 0) {
        header("Location: ../view/lostitem_reporting_pageview.php?error=Image file is required");
        exit();
    }
    if (isset($date)) {
        $date = date('Y-m-d', strtotime($date));
        if ($date === '1970-01-01' || strtotime($_POST['date']) === false) {
            header("Location: ../view/lostitem_reporting_page.php?error=Invalid date");
            exit();
        }
    } else {
        header("Location: ../view/lostitem_reporting_page.php?error=Date not set");
        exit();
    }

    if (isset($time)) {
        $time = date('H:i:s', strtotime($time));
    } else {
        header("Location: ../view/lostitem_reporting_page.php?error=Invalid time");
        exit();
    }


    if (empty($itemName)) {
        header("Location: ../view/lostitem_reporting_page.php?error=Item Name is required");
        exit();
    } else if (empty($locationLost)) {
        header("Location: ../view/lostitem_reporting_page.php?error=Location Lost is required");
        exit();
    } else if (empty($time)) {
        header("Location: ../view/lostitem_reporting_page.php?error=Time is required");
        exit();
    } else if (empty($itemDescription)) {
        header("Location: ../view/lostitem_reporting_page.php?error=Item Description is required");
        exit();
    }

    if (isset($_POST["category"])) {
        $category = $_POST["category"];
    } else {
        header("Location: ../view/lostitem_reporting_page.php?error=Please select a category.");
        exit();
    }

    
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (file_exists($target_file)) {
        header("Location: ../view/lostitem_reporting_page.php?error=Sorry, file already exists.");
        exit();
    }

    if ($uploadOk == 0) {
        header("Location: ../view/lostitem_reporting_page.php?error=Sorry, your file was not uploaded.");
    } else {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            $file_Size = $_FILES["photo"]["size"];

            $sql = "INSERT INTO image (file_name, file_size, file_type) VALUES ('$target_file', '$file_Size', '$imageFileType')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $sql_img = "SELECT * from image ORDER BY image_id DESC";
                $result_img = mysqli_query($conn, $sql_img);
                $row = mysqli_fetch_assoc($result_img);

                if ($row) {
                    $image_id = $row['image_id'];
                }
                $sql2 = "SELECT * from lost_items where item_name='$itemName' and time='$time' and location='$locationLost'";
                $result2 = mysqli_query($conn, $sql2);
                $count_items = mysqli_num_rows($result2);

                if ($count_items == 0) {
                    $sql3 = "INSERT INTO lost_items(rid,sid,image_id,item_name,time,location,description,datee,interaction_time,uid,category) VALUES('$userrole',1,'$image_id' ,'$itemName','$time','$locationLost','$itemDescription','$date',NOW(),'$userid','$category')";
                    $result3 = mysqli_query($conn, $sql3);

                    if ($result3) {
                        header("Location: ../view/item_lost.php");
                    }
                } else {
                    if ($count_items > 0) {
                        header("Location: ../view/lostitem_reporting_page.php?error=This item has already been declared lost in");
                    }
                }
            }
        } else {
            header("Location: ../view/lostitem_reporting_page.php?error=Sorry, there was an error uploading your file.");
        }
    }
}
