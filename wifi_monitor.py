from scapy.all import *
import requests
import mysql.connector
import telepot
import datetime

# Telegram Bot Token and Chat ID
TELEGRAM_BOT_TOKEN = ""
TELEGRAM_CHAT_ID = ""

# Database Connection
db = mysql.connector.connect(
    host="",
    user="",
    password="",
    database=""
)
cursor = db.cursor()

# Function to send Telegram alert
def send_telegram_alert(message):
    bot = telepot.Bot(TELEGRAM_BOT_TOKEN)
    bot.sendMessage(TELEGRAM_CHAT_ID, message)

# Function to process packets
def packet_callback(packet):
    try:
        timestamp = datetime.datetime.now()
        source_ip = packet.addr2 if hasattr(packet, "addr2") else "Unknown"
        destination_ip = packet.addr1 if hasattr(packet, "addr1") else "Unknown"
        protocol = packet.payload.name if hasattr(packet, "payload") else "Unknown"
        packet_info = str(packet.summary())

        # Store ALL packets for real-time monitoring
        cursor.execute("INSERT INTO live_packets (timestamp, source_ip, destination_ip, protocol, packet_info) VALUES (%s, %s, %s, %s, %s)", 
                       (timestamp, source_ip, destination_ip, protocol, packet_info))
        db.commit()

        # **Anomaly Detection**
        if packet.haslayer(Dot11):
            # Detect Deauthentication Attack
            if packet.type == 0 and packet.subtype == 12:
                message = f"🚨 Deauth attack detected from {source_ip}!"
                print(message)
                send_telegram_alert(message)
                cursor.execute("INSERT INTO anomalies (timestamp, type, source) VALUES (%s, %s, %s)", 
                               (timestamp, "Deauthentication Attack", source_ip))
                db.commit()

            # Example: Detect Suspicious Packets (Modify as needed)
            elif "TCP" in protocol and "Flags=R" in packet_info:
                message = f"⚠️ Suspicious TCP Reset Packet from {source_ip}"
                print(message)
                send_telegram_alert(message)
                cursor.execute("INSERT INTO anomalies (timestamp, type, source) VALUES (%s, %s, %s)", 
                               (timestamp, "Suspicious TCP Reset", source_ip))
                db.commit()

    except Exception as e:
        print(f"Error: {e}")

# Start Monitoring
print("📡 Monitoring WiFi network packets...")
sniff(iface="wlan1", prn=packet_callback, store=False)
