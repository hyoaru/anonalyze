from app.models.machine_learning.text_vectorizers.interfaces import TextVectorizerABC
from app.models.machine_learning.feature_selectors.interfaces import FeatureSelectorABC
from app.models.machine_learning.classification_models.sentiment_classification_models.interfaces import (
    SentimentClassificationModelABC,
)
from app.models.machine_learning.classification_models.sentiment_classification_models.naive_bayes_sentiment_classification_model import (
    NaiveBayesSentimentClassificationModel,
)


class SentimentClassificationModelFactory:
    @staticmethod
    def create_naive_bayes(
        text_vectorizer: TextVectorizerABC, feature_selector: FeatureSelectorABC
    ) -> SentimentClassificationModelABC:
        return NaiveBayesSentimentClassificationModel(text_vectorizer, feature_selector)
