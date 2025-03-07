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

    // Encode special characters
    $item_name = urlencode($item_name);
    $location = urlencode($location);
    $description = urlencode($description);

    $message .= "Item: $item_name\nLocation: $location\nDescription: $description\n\n";
}

// Define the recipient email address
$to = "recipient@example.com";

// Define the subject of the email
$subject = "Recent Lost Items";

// Encode the message content for the mailto link
$encoded_message = urlencode($message);

// Create the mailto link with the recipient, subject, and encoded message
$mailto_link = "mailto:$to?subject=$subject&body=$encoded_message";
?>

<!-- Create a link to trigger the email -->
<a href="<?php echo $mailto_link; ?>">Send Email</a>
