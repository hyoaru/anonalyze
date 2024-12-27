import joblib

from .interfaces import FeatureSelectorABC


class EmotionChi2Selector(FeatureSelectorABC):
    def __init__(self):
        super().__init__()

    def load(self):
        if self._selector is None:
            self._selector = joblib.load(
                f"{self._configurations.bin_path}/emotion_feature_selectors/chi_squared_emotion_feature_selector.pkl"
            )

    def transform(self, vector):
        return self._selector.transform(vector)
