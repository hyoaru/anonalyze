from .interfaces import TextVectorizerABC
import joblib


class TFIDFTextVectorizer(TextVectorizerABC):
    def __init__(self):
        super().__init__()

    def load(self):
        if self._vectorizer is None:
            self._vectorizer = joblib.load(
                f"{self._configurations.bin_path}/text_vectorizer_tfidf.pkl"
            )

    def transform(self, text: str):
        return self._vectorizer.transform([text])
