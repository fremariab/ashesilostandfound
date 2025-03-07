<?php
include "../settings/connection.php";

$sql = "SELECT * FROM lost_items as lo, image as i where lo.image_id=i.image_id";
$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
    for ($i = 0; $i < mysqli_num_rows($result); $i++) {
        $row = mysqli_fetch_assoc($result);

        $image_id = $row['image_id'];

        $sql_img = "SELECT * FROM image WHERE image_id = $image_id";
        $result_img = mysqli_query($conn, $sql_img);

        if ($result_img && mysqli_num_rows($result_img) == 1) {
            $img_row = mysqli_fetch_assoc($result_img);
            echo '<div class="item">';
            echo '<img src="' . $img_row['file_name'] . '" alt="" height="150px" class="image">';
            echo '<h3>' . $row['item_name'] . '</h3>';
            echo '<p>' . $row['description'] . '</p>';
            echo '<button onclick="openForm(\'../uploads/' . $img_row['file_name'] . '\', \'' . $row['item_name'] . '\', \'' . $row['description'] . '\', \'' . $row['location'] . '\', \'' . $row['time'] . '\')">View Details</button>';
            echo '</div>';
        }
    }
} else {
    echo '<p style="padding-top:100px;">No lost items.</p>';
}
