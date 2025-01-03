import requests
from app.configurations.llm_summarization_models.gemini_llm_summarization_model_configuration import (
    GeminiLlmSummarizationModelConfiguration,
)

from .interfaces import LlmSummarizationModelABC


class GeminiLlmSummarizationModel(LlmSummarizationModelABC):
    def __init__(self):
        super().__init__()
        self._configurations = GeminiLlmSummarizationModelConfiguration
        self._model_name = self._configurations.model_name
        self._headers = self._configurations.headers
        self._url = f"{self._configurations.api_url}{self._configurations.api_key}"

    def summarize(self, text: str) -> str:
        prompt: str = self.create_prompt(text)

        response = requests.post(
            url=self._url,
            headers=self._headers,
            json={"contents": [{"parts": [{"text": prompt}]}]},
        )

        response.raise_for_status()
        summary: str = response.json()["candidates"][0]["content"]["parts"][0]["text"]

        return summary

    def get_model_name(self):
        return self._model_name
