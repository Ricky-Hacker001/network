<?php
include('../db_connection.php');
$data = [
    "total_packets" => $conn->query("SELECT COUNT(*) as count FROM live_packets")->fetch_assoc()['count'],
    "total_anomalies" => $conn->query("SELECT COUNT(*) as count FROM anomalies")->fetch_assoc()['count'],
    "total_detections" => $conn->query("SELECT COUNT(*) as count FROM detections")->fetch_assoc()['count'],
    "total_images" => $conn->query("SELECT COUNT(*) as count FROM detections WHERE image_path IS NOT NULL")->fetch_assoc()['count']
];
echo json_encode($data);
?>
