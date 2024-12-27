import re
from .interfaces import TextProcessorABC


class DenoiseProcessor(TextProcessorABC):
    def process(self, text: str):
        text = re.sub(r"@\w+", "", text)
        text = re.sub(r"[^a-zA-Z ]", "", text)
        text = re.sub(r"https\w+", "", text)
        text = re.sub(r"http\w+", "", text)
        text = text.strip()
        text = text.lower()
        return self.process_next(text)
