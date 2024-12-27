from typing import Any

from app.utils.text_preprocessor.denoise_processor import DenoiseProcessor
from app.utils.text_preprocessor.lemmatize_processor import LemmatizeProcessor
from app.utils.text_preprocessor.remove_stopwords_processor import (
    RemoveStopwordsProcessor,
)
from app.models.machine_learning.classification_models.sentiment_classification_models.interfaces import (
    SentimentClassificationModelABC,
)


class SentimentController:
    def __init__(self, sentiment_classification_model: SentimentClassificationModelABC):
        self._sentiment_classification_model: Any = sentiment_classification_model

        self._text_processor = (
            DenoiseProcessor()
            .set_next_processor(RemoveStopwordsProcessor())
            .set_next_processor(LemmatizeProcessor())
        )

    def predict(self, text: str):
        preprocessed_text = self._text_processor.process(text)
        prediction = self._sentiment_classification_model.predict(preprocessed_text)

        return {
            "data": {
                "text": text,
                "predicted_value": {
                    "class": prediction[0],
                    "probability": prediction[1],
                },
            }
        }

    def model_info(self):
        # TODO: get model info

        return {
            "model_version": "v1.0",
            "algorithm": "Multinomial Naive Bayes",
            "trained_on": "Kaggle Twitter dataset",
        }

    def labels(self):
        return {"labels": ["positive", "negative", "neutral"]}
