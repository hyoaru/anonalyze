from app.models.machine_learning.text_vectorizers.interfaces import TextVectorizerABC
from app.models.machine_learning.text_vectorizers.tfidf_vectorizer import (
    TFIDFTextVectorizer,
)


class TextVectorizerFactory:
    @staticmethod
    def create_tfidf() -> TextVectorizerABC:
        return TFIDFTextVectorizer()
