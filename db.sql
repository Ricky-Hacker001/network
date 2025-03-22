CREATE TABLE anomalies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    source_ip VARCHAR(50),
    destination_ip VARCHAR(50),
    protocol VARCHAR(20),
    packet_info TEXT,
    attack_type VARCHAR(255),
    severity ENUM('Low', 'Medium', 'High') NOT NULL
);
DESC anomalies;
CREATE TABLE object_detections (
    id INT AUTO_INCREMENT PRIMARY KEY,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    sensor_id ENUM('Sensor1', 'Sensor2') NOT NULL,
    image_url VARCHAR(255) NOT NULL,
    status ENUM('Detected', 'Not Detected') NOT NULL
);
CREATE TABLE detections (
    id INT AUTO_INCREMENT PRIMARY KEY,
    timestamp DATETIME NOT NULL,
    location VARCHAR(50) NOT NULL,
    image_path VARCHAR(255)
);

CREATE TABLE admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL
);
CREATE TABLE live_packets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    ssid VARCHAR(100),
    source_ip VARCHAR(50),
    destination_ip VARCHAR(50),
    protocol VARCHAR(20),
    packet_info TEXT
);

