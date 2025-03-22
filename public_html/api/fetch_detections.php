<?php
include('../db_connection.php');

if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM detections ORDER BY timestamp DESC LIMIT 10");

if ($result->num_rows == 0) {
    echo "<tr><td colspan='3' class='text-center text-danger'>No objects detected yet.</td></tr>";
}

while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['timestamp']}</td>
        <td>{$row['location']}</td>
        <td><img src='../uploads/{$row['image_path']}' width='100'></td>
    </tr>";
}
?>
