from abc import ABC, abstractmethod


class TextProcessorABC(ABC):
    def __init__(self, next_processor=None):
        self.next_processor = next_processor

    def set_next_processor(self, next_processor):
        self.next_processor = next_processor
        return self

    @abstractmethod
    def process(self, text: str) -> str:
        pass

    def process_next(self, text: str):
        if self.next_processor:
            return self.next_processor.process(text)
        return text
