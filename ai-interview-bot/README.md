# AI Job Interview Bot

##  Overview
An AI-powered chatbot that helps users prepare for job interviews by asking questions and providing real-time feedback on responses.

##  Features
- Randomly selects interview questions.
- Accepts user responses via a web interface.
- Uses OpenAI's GPT-4 (or GPT-3.5) to evaluate and provide feedback.
- Simple UI built with Streamlit.
- Error handling for API limits and invalid inputs.

##  Project Structure
```
ai-interview-bot/
│── app.py                  # Main Streamlit app
│── questions.py             # List of interview questions
│── ai_logic.py              # AI logic (GPT prompt & evaluation)
│── .env                     # Stores API Key
│── requirements.txt         # Dependencies
│── README.md                # Documentation
```

##  Setup Instructions
1. **Clone or create the project directory**
   ```bash
   mkdir ai-interview-bot && cd ai-interview-bot
   ```
2. **Create necessary files**
   ```bash
   touch app.py questions.py ai_logic.py .env requirements.txt README.md
   ```
3. **Create a virtual environment and install dependencies**
   ```bash
   python -m venv venv
   source venv/bin/activate  # On Windows: venv\Scripts\activate
   pip install streamlit openai python-dotenv
   ```
4. **Run the application**
   ```bash
   streamlit run app.py
   ```

## 🔧 Libraries Used
- `streamlit` → **For UI** (Easy web app framework).
- `openai` → **For AI responses** (GPT-4 or GPT-3.5 for intelligent feedback).
- `random` → **For randomizing questions**.
- `dotenv` → **For managing API keys securely**.

##  Errors Encountered & Fixes
1. **Import Errors (`openai` or `dotenv` not found)**
   - **Fix**: Ensure virtual environment is activated before installing packages.
   - Run:
     ```bash
     source venv/bin/activate  # Windows: venv\Scripts\activate
     pip install -r requirements.txt
     ```

2. **API Key Not Working (`Error 401 - Invalid API Key`)**
   - **Fix**: Ensure API key is correct and stored in `.env` file.
   - `.env` example:
     ```
     OPENAI_API_KEY=sk-your-api-key
     ```

3. **OpenAI Quota Exceeded (`Error 429 - Insufficient Quota`)**
   - **Fix**: Check OpenAI usage at [OpenAI Dashboard](https://platform.openai.com/account/usage).
   - Consider switching to `gpt-3.5-turbo` to save API usage costs.

4. **Output Formatting Issues**
   - **Fix**: Used `st.markdown()` to format AI feedback clearly.
   - Handled cases where AI responses fail due to API limits.

## Future Improvements
- **Host on Streamlit Cloud** for live demo.
-  **Add AI grading system** (numerical scoring for responses).
-  **Implement voice input** (speech-to-text conversion for spoken responses).
-  **Store past responses** in a database for review.
-  **Add multilingual support** to allow non-English users to practice interviews.

## Conclusion
This project demonstrates AI integration, API handling, and UI development. It’s a strong portfolio piece that showcases practical AI applications.

Feel free to contribute or extend this project!
