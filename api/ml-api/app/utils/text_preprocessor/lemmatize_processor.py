from nltk import pos_tag
from nltk.corpus import wordnet
from nltk.stem import WordNetLemmatizer
from nltk.tokenize import TweetTokenizer

from .interfaces import TextProcessorABC


class LemmatizeProcessor(TextProcessorABC):
    def process(self, text: str):
        wordnet_lemmatizer = WordNetLemmatizer()
        tokenizer = TweetTokenizer()

        wordnet_pos_tag_map = {
            "J": wordnet.ADJ,
            "N": wordnet.NOUN,
            "V": wordnet.VERB,
            "R": wordnet.ADV,
        }

        tokens = tokenizer.tokenize(text)
        pos_tags = pos_tag(tokens)

        lemmatized_tokens = []
        for token, tag in pos_tags:
            wordnet_tag = wordnet_pos_tag_map.get(tag[0].upper())
            if wordnet_tag is None:
                lemmatized_tokens.append(token)
            else:
                lemmatized_tokens.append(
                    wordnet_lemmatizer.lemmatize(token, wordnet_tag)
                )

        return " ".join(lemmatized_tokens)
