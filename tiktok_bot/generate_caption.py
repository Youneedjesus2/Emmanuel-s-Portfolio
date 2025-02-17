import os
import openai
from dotenv import load_dotenv
import random

# Load environment variables from .env file
load_dotenv()

# Retrieve the API key from environment variables
openai_api_key = os.getenv("OPENAI_API_KEY")

if not openai_api_key:
    raise ValueError("OpenAI API key not found. Please set it in the .env file.")

# Set the API key
openai.api_key = openai_api_key

# List of TikTok content types
content_types = [
    "AI automation",
    "motivational content",
    "funny memes",
    "life hacks",
    "tech reviews",
    "entrepreneurship tips",
    "fitness inspiration",
    "self-improvement",
    "coding tutorials",
    "viral trends"
]

# Function to generate a caption
def generate_caption():
    topic = random.choice(content_types)  # Pick a random content type
    prompt = f"Generate a viral TikTok caption for {topic} with hashtags."

    response = openai.ChatCompletion.create(
        model="gpt-3.5-turbo",
        messages=[
            {"role": "system", "content": "You are a creative assistant."},
            {"role": "user", "content": prompt}
        ],
        max_tokens=50,
        temperature=0.7
    )

    caption = response.choices[0].message["content"].strip()
    return caption

if __name__ == "__main__":
    caption = generate_caption()
    print("Generated Caption:")
    print(caption)
