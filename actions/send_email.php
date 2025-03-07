<?php
// Include your database connection
include "../settings/connection.php";

// Retrieve the 5 most recent lost items from the database
$sql = "SELECT * FROM lost_items ORDER BY interaction_time DESC LIMIT 5";
$result = mysqli_query($conn, $sql);

// Initialize message content
$message = "Recent Lost Items:\n";

// Loop through the results and add each item to the message
while ($row = mysqli_fetch_assoc($result)) {
    $item_name = $row['item_name'];
    $location = $row['location'];
    $description = $row['description'];

    // Encode special characters using rawurlencode
    $item_name = rawurlencode($item_name);
    $location = rawurlencode($location);
    $description = rawurlencode($description);

    $item_name = str_replace('%20', ' ', $item_name);
    $location = str_replace('%20', ' ', $location);
    $description = str_replace('%20', ' ', $description);
    $message .= "Item: $item_name\nLocation: $location\nDescription: $description\n\n";
}

// Define the recipient email address
$to = "dsampah@ashesi.edu.gh";

// Define the subject of the email
$subject = "Recent Lost Items";

// Encode the message content for the mailto link
$encoded_message = rawurlencode($message);

// Create the mailto link with the recipient, subject, and encoded message
$mailto_link = "mailto:$to?subject=$subject&body=$encoded_message";
