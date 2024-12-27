from abc import ABC, abstractmethod
from app.configurations.configurations import Configurations
from typing import Any


class FeatureSelectorABC(ABC):
    _instance = None
    _configurations = Configurations.FeatureSelectors

    def __init__(self):
        self._selector: Any = None
        pass

    def __new__(cls):
        if cls._instance is None:
            cls._instance = super(FeatureSelectorABC, cls).__new__(cls)
        return cls._instance

    @abstractmethod
    def transform(self, vector):
        pass

    @abstractmethod
    def load(self):
        pass
