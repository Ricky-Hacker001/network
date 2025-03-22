function fetchWifiData() {
    fetch('api/fetch_logs.php')
    .then(response => response.json())
    .then(data => {
        let content = "<table><tr><th>Time</th><th>MAC</th><th>Signal</th></tr>";
        data.forEach(log => {
            content += `<tr><td>${log.detected_at}</td><td>${log.mac_address}</td><td>${log.signal_strength}</td></tr>`;
        });
        content += "</table>";
        document.getElementById('wifi-data').innerHTML = content;
    });
}

function fetchAlerts() {
    fetch('alerts.php')
    .then(response => response.text())
    .then(data => {
        document.getElementById('alerts').innerHTML = data;
    });
}

function fetchCapturedImages() {
    fetch('captured_images.php')
    .then(response => response.text())
    .then(data => {
        document.getElementById('captured-images').innerHTML = data;
    });
}
