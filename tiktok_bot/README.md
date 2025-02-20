# **TikTok Auto-Posting Bot** 🤖🎥  
_Automate your TikTok content strategy with AI-powered captions and scheduled uploads!_

---

## **📌 Overview**  
This project automates **TikTok video posting** with AI-generated captions and trending hashtags.  

### 🚀 **Features**  
✅ **Automated Login** – Logs into TikTok automatically.  
✅ **Scheduled Uploads** – Uploads videos at predefined times.  
✅ **AI-Powered Captions** – Uses OpenAI API to generate engaging captions.  
✅ **Trending Hashtags** – Fetches top-performing hashtags for better reach.  

---

## **📂 Project Structure**  
```
tiktok_bot/
│── videos/              # Store videos to upload
│── logs/                # Store logs for debugging
│── assets/              # Store assets (images, audio)
│── env/                 # Virtual environment (optional)
│── tiktok_login.py      # TikTok login automation
│── tiktok_upload.py     # Upload automation script
│── get_hashtags.py      # Fetch trending hashtags
│── generate_caption.py  # AI-generated captions
│── schedule_tiktok.py   # Scheduled posting logic
│── requirements.txt     # Dependencies for the bot
│── .env                 # API keys (excluded from version control)
│── README.md            # Documentation
```

---

## **⚙️ Setup Instructions**  

### **1️⃣ Create a Virtual Environment**  
```bash
python -m venv env  
# Activate on macOS/Linux  
source env/bin/activate  
# Activate on Windows  
env\Scripts\activate  
```

### **2️⃣ Install Dependencies**  
```bash
pip install -r requirements.txt  
```

### **3️⃣ Set Up API Keys**  
Create a `.env` file in the project directory and add:  
```
OPENAI_API_KEY=your_openai_api_key_here
```

---

## **🚀 Running the Bot**  

### **1️⃣ Generate AI Captions**  
```bash
python generate_caption.py
```

### **2️⃣ Fetch Trending Hashtags**  
```bash
python get_hashtags.py
```

### **3️⃣ Upload Video to TikTok**  
```bash
python tiktok_upload.py
```

### **4️⃣ Schedule TikTok Posting**  
```bash
python schedule_tiktok.py
```

---

## **⚠️ Troubleshooting**  

### ❌ API Rate Limit Error  
🔹 Check your OpenAI quota: [OpenAI Usage](https://platform.openai.com/account/usage)  
🔹 Use a different API key or upgrade your plan.  

### ❌ Virtual Environment Not Activating  
🔹 Ensure you're in the correct directory.  
🔹 Try:  
```bash
source env/Scripts/activate  # On Git Bash (Windows)
```

### ❌ TikTok Login Issues  
🔹 Run `tiktok_login.py` separately and **log in manually** if needed.  

---

## **🔮 Future Improvements**  
✅ **Use a free AI model** (Google Gemini, Hugging Face) to reduce API costs.  
✅ **Automate comment replies** using AI-generated responses.  
✅ **Enhance video editing** with AI overlays and effects.  

---

### **👨‍💻 Contributors**  
💡 Created by **[Your Name]**  
📧 Contact: Emmanuel.adeniyi2003@gmail.com  
🔗 **GitHub:** [Your Repo Link]  
🔗 **LinkedIn:** [Your LinkedIn Profile]  

---
