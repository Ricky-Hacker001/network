<?php
include('../db_connection.php');

$query = "SELECT * FROM wifi_logs ORDER BY detected_at DESC";
$result = $conn->query($query);

$logs = [];
while ($row = $result->fetch_assoc()) {
    $logs[] = $row;
}

echo json_encode($logs);
?>
