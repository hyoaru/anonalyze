from abc import ABC, abstractmethod
from app.configurations.configurations import Configurations
from typing import Any


class EmotionClassificationModelABC(ABC):
    _instance = None
    _configurations = Configurations.MachineLearning.ClassificationModels

    def __init__(self, *args, **kwargs):
        self._model: Any = None
        pass

    def __new__(cls, *args, **kwargs):
        if cls._instance is None:
            cls._instance = super(EmotionClassificationModelABC, cls).__new__(cls)
        return cls._instance

    @abstractmethod
    def load(self):
        pass

    @abstractmethod
    def predict(self, text: str) -> tuple[str, Any]:
        pass
