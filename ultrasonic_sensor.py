import RPi.GPIO as GPIO
import time
import requests
import telepot
import mysql.connector

# 🔹 Telegram Bot Token and Chat ID
TELEGRAM_BOT_TOKEN = "YOUR TELEGRAM BOT TOKEN"
TELEGRAM_CHAT_ID = "YOUR TELEGRAM CHAT ID"

# 🔹 MySQL Database Connection
DB_HOST = "HOSTINER REMOTE ACCESS CD IP"
DB_USER = "DATABSE USER NAME"
DB_PASSWORD = "PASSWORD"
DB_NAME = "BD NAME"

# 🔹 Sensor Pins
SENSORS = [
    {"trigger": 23, "echo": 24, "name": "Entrance 1"},
    {"trigger": 17, "echo": 27, "name": "Entrance 2"}
]

# 🔹 Initialize GPIO
GPIO.setmode(GPIO.BCM)
for sensor in SENSORS:
    GPIO.setup(sensor["trigger"], GPIO.OUT)
    GPIO.setup(sensor["echo"], GPIO.IN)

# 🔹 Function to get distance from ultrasonic sensor
def get_distance(sensor):
    GPIO.output(sensor["trigger"], True)
    time.sleep(0.00001)
    GPIO.output(sensor["trigger"], False)

    start_time = time.time()
    stop_time = time.time()

    while GPIO.input(sensor["echo"]) == 0:
        start_time = time.time()

    while GPIO.input(sensor["echo"]) == 1:
        stop_time = time.time()

    elapsed_time = stop_time - start_time
    distance = (elapsed_time * 34300) / 2  # in cm
    return distance

# 🔹 Function to Capture Image
def capture_image():
    image_url = "IF YOU USE YOUR MOBILE CAMERA YOUR CAMERA IP"
    try:
        response = requests.get(image_url, timeout=5)
        if response.status_code == 200:
            image_path = f"/var/www/html/uploads/detected_{int(time.time())}.jpg"
            with open(image_path, "wb") as f:
                f.write(response.content)
            return image_path
        else:
            return None
    except requests.exceptions.RequestException:
        return None

# 🔹 Function to Insert Detection Data into Database
def insert_detection(sensor_name, image_path=None):
    try:
        conn = mysql.connector.connect(host=DB_HOST, user=DB_USER, password=DB_PASSWORD, database=DB_NAME)
        cursor = conn.cursor()
        timestamp = time.strftime('%Y-%m-%d %H:%M:%S')

        sql = "INSERT INTO detections (timestamp, location, image_path) VALUES (%s, %s, %s)"
        cursor.execute(sql, (timestamp, sensor_name, image_path))

        conn.commit()
        conn.close()
    except mysql.connector.Error as err:
        print(f"Database error: {err}")

# 🔹 Function to Send Telegram Alerts
def send_telegram_alert(message, image=None):
    bot = telepot.Bot(TELEGRAM_BOT_TOKEN)
    bot.sendMessage(TELEGRAM_CHAT_ID, message)
    if image:
        bot.sendPhoto(TELEGRAM_CHAT_ID, photo=open(image, "rb"))

# 🔹 Main Monitoring Function
def monitor_sensors():
    while True:
        for sensor in SENSORS:
            distance = get_distance(sensor)
            if distance < 10:  # Object detected within 10cm
                message = f"🚨 Object detected at {sensor['name']}"
                print(message)

                # Capture Image
                image_path = capture_image()

                # Send Telegram Alert
                send_telegram_alert(message, image_path)

                # Insert Detection into Database
                insert_detection(sensor["name"], image_path)

        time.sleep(1)

# 🔹 Start Monitoring
try:
    monitor_sensors()
except KeyboardInterrupt:
    GPIO.cleanup()
