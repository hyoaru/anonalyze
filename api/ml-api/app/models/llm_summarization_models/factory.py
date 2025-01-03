from app.models.llm_summarization_models.gemini_llm_summarization_model import (
    GeminiLlmSummarizationModel,
)


class LlmSummarizationModelFactory:
    @staticmethod
    def create_gemini() -> GeminiLlmSummarizationModel:
        return GeminiLlmSummarizationModel()
