<?php
include "../settings/connection.php";

// Get the current page from the URL parameter, default to 1 if not set
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the offset based on the current page with 10 activities
$limit = 10;
$offset = ($current_page - 1) * $limit;

$query_activities = "
   SELECT CONCAT(u.fname, ' ', u.lname) AS person_name, 
       li.interaction_time AS interaction_date, 
       'Reported a lost item' AS activity
FROM lost_items li
JOIN user u ON li.uid = u.uid
UNION ALL
SELECT CONCAT(u.fname, ' ', u.lname) AS person_name, 
       fi.interaction_time AS interaction_date, 
       'Found a lost item' AS activity
FROM found_items fi
JOIN user u ON fi.uid = u.uid
UNION ALL
SELECT CONCAT(u.fname, ' ', u.lname) AS person_name, 
       ci.interaction_time AS interaction_date, 
       'Claimed a found item' AS activity
FROM claimed_items ci
JOIN user u ON ci.uid = u.uid
ORDER BY interaction_date DESC
LIMIT $limit OFFSET $offset;
";

$result = mysqli_query($conn, $query_activities);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td><p>" . $row['person_name'] . "</p></td>";
        echo "<td>" . $row['interaction_date'] . "</td>";
        echo "<td>" . $row['activity'] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3'>No recent activities found.</td></tr>";
}

mysqli_close($conn);
