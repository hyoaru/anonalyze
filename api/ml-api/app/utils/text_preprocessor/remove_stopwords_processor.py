import re
from nltk.corpus import stopwords
from .interfaces import TextProcessorABC


class RemoveStopwordsProcessor(TextProcessorABC):
    def process(self, text: str):
        matcher = re.compile(
            r"|".join([rf"\b{word}\b" for word in stopwords.words("english")])
        )

        processed_text = " ".join(matcher.sub("", text).split())

        return self.process_next(processed_text)
