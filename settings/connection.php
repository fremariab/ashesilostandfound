<?php

$SERVER = "localhost";
$USERNAME = "root";
$PSSWRD = "cs341webtech";
$DATABASE = "lost_n_found";

$conn = new mysqli($SERVER, $USERNAME, $PSSWRD, $DATABASE);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "";
