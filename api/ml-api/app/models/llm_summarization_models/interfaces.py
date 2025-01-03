from abc import ABC, abstractmethod


class LlmSummarizationModelABC(ABC):
    def __init__(self):
        self._model_name = None

    def create_prompt(self, text: str) -> str:
        prompt = f""""
            Summarize the following statements based on their predicted sentiments. 
            The statements are labeled with either [positive], [negative], or [neutral] to indicate their sentiment. 
            Provide a balanced summary report in strictly 5 sentences that captures both the overall sentiment distribution and key insights from the statements.

            [START]
            {text}
            [END]
        """

        return prompt

    @abstractmethod
    def summarize(self, text: str) -> str:
        pass

    @abstractmethod
    def get_model_name(self) -> str:
        pass
