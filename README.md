# network
This WiFi Network Monitoring &amp; Anomaly Detection System is designed to monitor WiFi networks in real-time, detect anomalies, and send alerts to an admin dashboard and Telegram. It uses a Raspberry Pi 4, TP-Link monitor mode WiFi adapter, ultrasonic sensors, and the Pi Camera Module to track suspicious activities and security threats.

WiFi Network Monitoring & Anomaly Detection System
🚀 Open-source project by NuetreX.io

📌 About the Project
This WiFi Network Monitoring & Anomaly Detection System is designed to monitor WiFi networks in real-time, detect anomalies, and send alerts to an admin dashboard and Telegram. It uses a Raspberry Pi 4, TP-Link monitor mode WiFi adapter, ultrasonic sensors, and the Pi Camera Module to track suspicious activities and security threats.

🔍 Key Features:

✅ Live WiFi Packet Monitoring – Captures and analyzes network packets in real time.

✅ Anomaly Detection – Detects deauthentication attacks, rogue access points, and unusual network activity.

✅ Real-time Alerts – Sends alerts to Telegram & Web Dashboard when an anomaly is detected.

✅ Pi Camera Module Integration – Captures images when an object is detected.

✅ Ultrasonic Sensors – Monitors entry points for physical intrusions.

✅ Secure Admin Dashboard – Displays live packets, detected anomalies, captured images, and network trends with interactive graphs.

✅ Cloud Storage – Stores network anomalies, logs, and captured images in a database hosted on Hostinger.

⚙️ Tech Stack
Hardware: Raspberry Pi 4, TP-Link WiFi Adapter (Monitor Mode), Pi Camera Module, Ultrasonic Sensors

Software: Python (Scapy, OpenCV, Telepot, MySQL Connector), PHP, JavaScript

Database: MySQL (Hosted on Hostinger)

Cloud Storage: Captured images and network logs

Alerts: Telegram Bot & Web Dashboard

📸 System Architecture
plaintext
Copy
Edit
WiFi Adapter (Monitor Mode) → Packet Sniffing (Scapy) → Anomaly Detection →  
→ Telegram & Web Dashboard Alerts → Cloud Database (MySQL) → Admin Dashboard  
Ultrasonic Sensors → Object Detection → Pi Camera Captures Image → Stored in Database  
🚀 Getting Started
1. Clone the Repository
bash
Copy
Edit
git clone https://github.com/NuetreX-io/wifi-network-monitoring.git
cd wifi-network-monitoring
2. Install Dependencies
bash
Copy
Edit
pip install scapy mysql-connector-python telepot opencv-python
3. Run the Network Monitor
bash
Copy
Edit
sudo python3 wifi_monitor.py
4. Start the Web Dashboard
Upload the PHP files to a Hostinger or local server and access via browser.

🛠️ Configuration
Update database credentials in wifi_monitor.py and config.php.

Set up your Telegram Bot Token in wifi_monitor.py.

Ensure your WiFi adapter supports monitor mode.

🏆 Hackathon Winner & Open Source Contribution
This project won 1st place at an IoT Hackathon and is now open-sourced under NuetreX.io to contribute to cybersecurity & IoT innovations.

📬 Contributing
We welcome contributions! Feel free to submit issues, feature requests, or pull requests. Let’s build a smarter and more secure network monitoring system together.

