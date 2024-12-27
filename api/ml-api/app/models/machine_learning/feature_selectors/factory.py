from app.models.machine_learning.feature_selectors.emotion_chi_squared_selector import (
    EmotionChiSquaredSelector,
)
from app.models.machine_learning.feature_selectors.sentiment_chi_squared_selector import (
    SentimentChiSquaredSelector,
)
from app.models.machine_learning.feature_selectors.interfaces import FeatureSelectorABC


class FeatureSelectorFactory:
    @staticmethod
    def create_chi_squared_emotion() -> FeatureSelectorABC:
        return EmotionChiSquaredSelector()

    @staticmethod
    def create_chi_squared_sentiment() -> FeatureSelectorABC:
        return SentimentChiSquaredSelector()
