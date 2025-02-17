import schedule
import time
import subprocess

def post_video():
    subprocess.run(["python", "tiktok_upload.py"])

# Schedule to post every day at 12 PM
schedule.every().day.at("12:00").do(post_video)

while True:
    schedule.run_pending()
    time.sleep(60)  # Check every minute
