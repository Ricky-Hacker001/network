<?php
include('../db_connection.php');
$result = $conn->query("SELECT * FROM live_packets ORDER BY timestamp DESC LIMIT 20");
while($row = $result->fetch_assoc()) {
    echo "<tr><td>{$row['timestamp']}</td><td>{$row['ssid']}</td><td>{$row['source_ip']}</td><td>{$row['destination_ip']}</td><td>{$row['protocol']}</td><td>{$row['packet_info']}</td></tr>";
}
?>
