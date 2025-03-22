<?php
$servername = "";
$username = "";
$password = "";
$dbname = "";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Network Monitoring</title>
    
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body { font-family: Arial, sans-serif; }
        .anomaly { background-color: red; color: white; font-weight: bold; }
        .dashboard-card { padding: 20px; text-align: center; border-radius: 8px; color: white; }
        .bg-primary { background-color: #007bff !important; }
        .bg-danger { background-color: #dc3545 !important; }
        .bg-warning { background-color: #ffc107 !important; color: black; }
        .bg-success { background-color: #28a745 !important; }
    </style>
    
</head>
<body>

    <div class="container mt-4">
        <h1 class="text-center">Live Network Monitoring Dashboard</h1>

        <!-- Summary Cards -->
        <div class="row mt-4">
            <div class="col-md-3">
                <div class="dashboard-card bg-primary">
                    <h3 id="totalPackets">0</h3>
                    <p>Total Packets</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dashboard-card bg-danger">
                    <h3 id="totalAnomalies">0</h3>
                    <p>Anomalies Detected</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dashboard-card bg-warning">
                    <h3 id="totalDetections">0</h3>
                    <p>Detected Objects</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dashboard-card bg-success">
                    <h3 id="totalImages">0</h3>
                    <p>Captured Images</p>
                </div>
            </div>
        </div>

        <!-- Live Network Packets -->
        <h2 class="mt-4">Live Network Packets</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Timestamp</th>
                    <th>WiFi Name (SSID)</th>
                    <th>Source IP</th>
                    <th>Destination IP</th>
                    <th>Protocol</th>
                    <th>Packet Info</th>
                </tr>
            </thead>
            <tbody id="packetTable">
                <!-- Dynamic Data Loaded Here -->
            </tbody>
        </table>

        <!-- Anomaly Detection -->
        <h2 class="mt-4">Detected Anomalies</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Timestamp</th>
                    <th>WiFi Name (SSID)</th>
                    <th>Type</th>
                    <th>Source</th>
                </tr>
            </thead>
            <tbody id="anomalyTable">
                <!-- Dynamic Data Loaded Here -->
            </tbody>
        </table>

        <!-- Object Detection -->
        <h2 class="mt-4">Detected Objects</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Timestamp</th>
                    <th>Location</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody id="detectionTable">
                <!-- Dynamic Data Loaded Here -->
            </tbody>
        </table>

        <!-- Graphs -->
        <h2 class="mt-4">Anomaly Trends</h2>
        <canvas id="anomalyChart"></canvas>

    </div>

    <script>
        function fetchDashboardData() {
            fetch('api/dashboard_stats.php')
            .then(response => response.json())
            .then(data => {
                document.getElementById('totalPackets').innerText = data.total_packets;
                document.getElementById('totalAnomalies').innerText = data.total_anomalies;
                document.getElementById('totalDetections').innerText = data.total_detections;
                document.getElementById('totalImages').innerText = data.total_images;
            });
        }

        function fetchLiveData() {
            fetch('api/fetch_packets.php')
            .then(response => response.text())
            .then(data => { document.getElementById('packetTable').innerHTML = data; });

            fetch('api/fetch_anomalies.php')
            .then(response => response.text())
            .then(data => { document.getElementById('anomalyTable').innerHTML = data; });

            fetch('api/fetch_detections.php')
            .then(response => response.text())
            .then(data => { document.getElementById('detectionTable').innerHTML = data; });
        }

        function fetchAnomalyChart() {
            fetch('api/fetch_anomaly_chart.php')
            .then(response => response.json())
            .then(data => {
                new Chart(document.getElementById('anomalyChart'), {
                    type: 'line',
                    data: {
                        labels: data.labels,
                        datasets: [{ label: 'Anomalies', data: data.counts, borderColor: 'red', fill: false }]
                    }
                });
            });
        }

        setInterval(fetchDashboardData, 5000);
        setInterval(fetchLiveData, 5000);
        fetchAnomalyChart();
    </script>

</body>
</html>
