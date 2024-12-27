from .interfaces import EmotionClassificationModelABC
from app.models.machine_learning.text_vectorizers.interfaces import TextVectorizerABC
from app.models.machine_learning.feature_selectors.interfaces import FeatureSelectorABC
import joblib


class NaiveBayesEmotionClassificationModel(EmotionClassificationModelABC):
    _label_description_map = {
        0: "sadness",
        1: "joy",
        2: "love",
        3: "anger",
        4: "fear",
        5: "surprised",
    }

    def __init__(self, vectorizer: TextVectorizerABC, selector: FeatureSelectorABC):
        super().__init__()
        self._vectorizer = vectorizer
        self._selector = selector
        self.load()

    def load(self):
        if self._model is None:
            self._model = joblib.load(
                f"{self._configurations.bin_path}/emotion_classification_models/naive_bayes_emotion_classification_model.pkl"
            )

    def predict(self, text: str):
        vector = self._vectorizer.transform(text)
        vector = self._selector.transform(vector)

        predicted_probabilities_map = dict(
            zip(
                self._label_description_map.values(),
                self._model.predict_proba(vector)[0],
            )
        )

        prediction = max(predicted_probabilities_map.items(), key=lambda x: x[1])
        return prediction
