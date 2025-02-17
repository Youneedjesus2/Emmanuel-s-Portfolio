import openai
import os
from dotenv import load_dotenv  # Ensure dotenv is imported

# Load API key from .env file
load_dotenv()
api_key = os.getenv("OPENAI_API_KEY")

if not api_key:
    raise ValueError("🚨 API key is missing! Check your .env file.")

def analyze_answer(question, user_answer, api_key):
    """
    Function to send the user's answer to OpenAI API for evaluation and feedback.
    """
    client = openai.OpenAI(api_key=api_key)  # Corrected API key usage

    prompt = f"""
    You are an AI interview coach. Evaluate the following response to the question: '{question}'
    and provide feedback on clarity, relevance, grammar, and completeness.

    User's Response: "{user_answer}"
    
    Provide your feedback:
    """

    try:
        response = client.chat.completions.create(
            model="gpt-3.5-turbo",
            messages=[{"role": "system", "content": prompt}]
        )
        
        return response.choices[0].message.content.strip()

    except Exception as e:
        return f"Error processing response: {str(e)}"
