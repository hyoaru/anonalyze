import os
from dotenv import load_dotenv
from app.configurations.interfaces import ConfigurationsABC

load_dotenv()


class GeminiLlmSummarizationModelConfiguration(ConfigurationsABC):
    model_name = "gemini"
    api_url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key="
    headers = {"Content-Type": "application/json"}
    api_key = os.getenv("GEMINI_API_KEY")
