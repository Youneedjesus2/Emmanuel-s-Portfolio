from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
import time

# TikTok Credentials
USERNAME = "your_username"
PASSWORD = "your_password"

# Set up Selenium WebDriver
driver = webdriver.Chrome()  # Ensure you have chromedriver installed
driver.get("https://www.tiktok.com/login")

time.sleep(5)  # Wait for the page to load

# Find the username input field and enter credentials
username_field = driver.find_element(By.NAME, "username")
password_field = driver.find_element(By.NAME, "password")

username_field.send_keys(USERNAME)
password_field.send_keys(PASSWORD)
password_field.send_keys(Keys.RETURN)

time.sleep(5)  # Allow time to login

print("Logged in successfully!")
