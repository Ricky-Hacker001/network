<?php
include('db_connection.php');
$result = $conn->query("SELECT * FROM alerts ORDER BY created_at DESC");

echo "<ul>";
while ($row = $result->fetch_assoc()) {
    echo "<li>".$row['message']." - ".$row['created_at']."</li>";
}
echo "</ul>";
?>
