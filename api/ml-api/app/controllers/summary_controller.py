from app.models.llm_summarization_models.interfaces import LlmSummarizationModelABC


class SummaryController:
    def __init__(self, summarization_model: LlmSummarizationModelABC):
        self._summarization_model: LlmSummarizationModelABC = summarization_model

    def summarize(self, text: str):
        return {"text": text, "summary": self._summarization_model.summarize(text)}

    def model_info(self):
        return {
            "model": self._summarization_model.get_model_name(),
        }
