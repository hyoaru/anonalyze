from .interfaces import SentimentClassificationModelABC
from app.models.machine_learning.text_vectorizers.interfaces import TextVectorizerABC
from app.models.machine_learning.feature_selectors.interfaces import FeatureSelectorABC
import joblib


class NaiveBayesSentimentClassificationModel(SentimentClassificationModelABC):
    _sentiment_label_description_map = {
        0: "negative",
        1: "positive",
        2: "neutral",
    }

    def __init__(self, vectorizer: TextVectorizerABC, selector: FeatureSelectorABC):
        super().__init__()
        self._vectorizer = vectorizer
        self._selector = selector
        self.load()

    def load(self):
        if self._model is None:
            self._model = joblib.load(
                f"{self._configurations.bin_path}/gender_classification_model.pkl"
            )

    def predict(self, text: str):
        vector = self._vectorizer.transform(text)
        vector = self._selector.transform(vector)

        predicted_probabilities_map = dict(
            zip(
                self._sentiment_label_description_map.values(),
                self._model.predict_proba(vector)[0],
            )
        )

        prediction = max(predicted_probabilities_map.items(), key=lambda x: x[1])
        return prediction
