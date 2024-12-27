import joblib

from .interfaces import FeatureSelectorABC


class EmotionChi2Selector(FeatureSelectorABC):
    def __init__(self):
        super().__init__()

    def load(self):
        if self._selector is None:
            self._selector = joblib.load(
                f"{self._configurations.bin_path}/selector_emotion_chi2.pkl"
            )

    def transform(self, vector):
        return self._selector.transform(vector)
