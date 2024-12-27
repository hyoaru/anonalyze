from app.models.machine_learning.text_vectorizers.interfaces import TextVectorizerABC
from app.models.machine_learning.feature_selectors.interfaces import FeatureSelectorABC
from app.models.machine_learning.classification_models.emotion_classification_models.interfaces import (
    EmotionClassificationModelABC,
)
from app.models.machine_learning.classification_models.emotion_classification_models.naive_bayes_emotion_classification_model import (
    NaiveBayesEmotionClassificationModel,
)


class EmotionClassificationModelFactory:
    @staticmethod
    def create_naive_bayes(
        text_vectorizer: TextVectorizerABC, feature_selector: FeatureSelectorABC
    ) -> EmotionClassificationModelABC:
        return NaiveBayesEmotionClassificationModel(text_vectorizer, feature_selector)
