<?php include('db_connection.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h1>Network Monitoring Dashboard</h1>
    <canvas id="wifiChart"></canvas>

    <script>
        async function fetchData() {
            let response = await fetch('api/fetch_logs.php');
            let data = await response.json();
            updateChart(data);
        }

        function updateChart(data) {
            let ctx = document.getElementById('wifiChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.map(log => log.detected_at),
                    datasets: [{
                        label: 'Anomalies',
                        data: data.map(log => log.signal_strength),
                        borderColor: 'red',
                        fill: false
                    }]
                }
            });
        }
        setInterval(fetchData, 5000);
    </script>
</body>
</html>
