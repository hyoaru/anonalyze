from abc import ABC, abstractmethod
from app.configurations.configurations import Configurations
from typing import Any


class TextVectorizerABC(ABC):
    _instance = None
    _configurations = Configurations.TextVectorizers

    def __init__(self):
        self._vectorizer: Any = None
        pass

    def __new__(cls):
        if cls._instance is None:
            cls._instance = super(TextVectorizerABC, cls).__new__(cls)
        return cls._instance

    @abstractmethod
    def transform(self, text: str):
        pass

    @abstractmethod
    def load(self):
        pass
