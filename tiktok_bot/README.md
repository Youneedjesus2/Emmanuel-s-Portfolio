TikTok Auto-Posting Bot

Overview

This project is a TikTok auto-posting bot that:

Logs into TikTok automatically.

Uploads videos on a schedule.

Generates AI-powered captions.

Fetches trending hashtags.

Uses OpenAI's API for caption generation.


Project Strcuture

tiktok_bot/
│── videos/              # Store videos to upload
│── logs/                # Store logs for debugging
│── assets/              # Store assets (images, audio)
│── env/                 # Virtual environment (optional)
│── tiktok_login.py      # TikTok login script
│── tiktok_upload.py     # Upload automation script
│── get_hashtags.py      # Fetch trending hashtags
│── generate_caption.py  # AI-generated captions
│── schedule_tiktok.py   # Scheduled posting
│── requirements.txt     # Dependencies for the bot
│── .env                 # API keys (not included in version control)
│── README.md            # Documentation


Set-up

1. create virtual environment 
python -m venv env
source env/bin/activate  # On macOS/Linux
env\Scripts\activate    # On Windows

2. install dependencies

pip install -r requirements.txt

3. setup api keys(create .env file and add folliwng to file)
OPENAI_API_KEY=your_openai_api_key_here

Running the Bot

1. Generate Captions

python generate_caption.py

2. Fetch Trending Hashtags

python get_hashtags.py

3. Upload Video to TikTok

python tiktok_upload.py

4. Schedule TikTok Posting

python schedule_tiktok.py



Troubleshooting

❌ API Rate Limit Error

Check your OpenAI quota: https://platform.openai.com/account/usage

Use a different API key or upgrade your plan.

❌ Virtual Environment Not Activating

Ensure you're in the correct directory.

Try: source env/Scripts/activate on Git Bash.

❌ TikTok Login Issues

Run tiktok_login.py separately and log in manually if needed.

Future Improvements

✅ Use a free AI model like Google Gemini or Hugging Face.
✅ Automate comment replies using AI.
✅ Enhance video editing with AI overlays.