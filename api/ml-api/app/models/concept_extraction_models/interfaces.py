from abc import ABC, abstractmethod
from typing import Any


class ConceptExtractionModelABC(ABC):
    _instance = None

    def __init__(self, *args, **kwargs):
        self._model: Any = None
        pass

    def __new__(cls, *args, **kwargs):
        if cls._instance is None:
            cls._instance = super(ConceptExtractionModelABC, cls).__new__(cls)
        return cls._instance

    @abstractmethod
    def extract(self, text_list: list[str]) -> dict:
        pass
