import time
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys

# Set up TikTok WebDriver
driver = webdriver.Chrome()
driver.get("https://www.tiktok.com/upload?lang=en")

time.sleep(5)  # Wait for the upload page to load

# Locate file upload input
upload_input = driver.find_element(By.XPATH, '//input[@type="file"]')
upload_input.send_keys("/path/to/your/video.mp4")  # Change this to your actual video path

time.sleep(10)  # Allow time for video to upload

# Add Caption
caption_box = driver.find_element(By.XPATH, '//div[contains(@class, "public-DraftEditor-content")]')
caption_box.click()
caption_box.send_keys("🚀 Check out this amazing video! #AI #Automation #TikTokBot")

time.sleep(3)

# Click the post button
post_button = driver.find_element(By.XPATH, '//button[contains(text(), "Post")]')
post_button.click()

print("Video uploaded successfully!")

time.sleep(10)
driver.quit()
