<?php
include('../db_connection.php');

// Check for errors
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

// Fetch anomalies
$result = $conn->query("SELECT * FROM anomalies ORDER BY timestamp DESC LIMIT 10");

// If no data found, show a message
if ($result->num_rows == 0) {
    echo "<tr><td colspan='4' class='text-center text-danger'>No anomalies detected yet.</td></tr>";
}

// Display fetched data
while ($row = $result->fetch_assoc()) {
    echo "<tr><td>{$row['timestamp']}</td><td>{$row['ssid']}</td><td>{$row['type']}</td><td>{$row['source']}</td></tr>";
}
?>
