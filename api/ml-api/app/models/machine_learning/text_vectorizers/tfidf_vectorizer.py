from .interfaces import TextVectorizerABC
import joblib


class TFIDFTextVectorizer(TextVectorizerABC):
    def __init__(self):
        super().__init__()
        self.load()

    def load(self):
        if self._vectorizer is None:
            self._vectorizer = joblib.load(
                f"{self._configurations.bin_path}/tfidf_text_vectorizer.pkl"
            )

    def transform(self, text: str):
        return self._vectorizer.transform([text])
