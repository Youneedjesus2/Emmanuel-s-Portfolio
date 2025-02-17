import streamlit as st
import random
import os
from ai_logic import analyze_answer
from questions import interview_questions
from dotenv import load_dotenv

# Load API key from .env file
load_dotenv()
OPENAI_API_KEY = os.getenv("OPENAI_API_KEY")

# Streamlit UI
st.title("💬 AI Job Interview Bot")
st.write("Answer job interview questions and get AI feedback!")

# Function to select a random question
def get_random_question():
    return random.choice(interview_questions)

# Session state to track the current question
if "question" not in st.session_state:
    st.session_state.question = get_random_question()

if st.button("🎤 New Question"):
    st.session_state.question = get_random_question()

st.subheader("Question:")
st.write(st.session_state.question)

# User input for answer
user_input = st.text_area("Your Answer:")

# Check if user input is too short
if len(user_input.split()) < 5:
    st.warning("⚠️ Your response is too short. Try adding more details about your strengths and weaknesses.")

# AI analysis and feedback
if st.button("Submit Answer"):
    if user_input.strip():
        feedback_text = analyze_answer(st.session_state.question, user_input, OPENAI_API_KEY)
        
        # Handle OpenAI API errors gracefully
        if "Error processing response" in feedback_text or "insufficient_quota" in feedback_text:
            st.error("⚠️ AI is currently unavailable due to quota limits. Please try again later or upgrade your OpenAI account.")
        else:
            # Ensure the feedback is properly formatted
            st.subheader("AI Feedback:")
            st.markdown(f"""
            **📌 Clarity:** N/A  
            **🎯 Relevance:** N/A  
            **✍️ Grammar:** N/A  
            **📖 Completeness:** N/A  
            
            **💡 Suggested Answer:** {feedback_text}  
            """)
    else:
        st.warning("Please enter an answer before submitting!")