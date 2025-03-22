<?php
include('db_connection.php');
$result = $conn->query("SELECT * FROM wifi_logs ORDER BY detected_at DESC");

echo "<table><tr><th>Time</th><th>MAC Address</th><th>Signal Strength</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr><td>".$row['detected_at']."</td><td>".$row['mac_address']."</td><td>".$row['signal_strength']."</td></tr>";
}
echo "</table>";
?>
