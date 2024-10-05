import re
import nltk

from nltk import pos_tag, sent_tokenize, RegexpParser
from nltk.corpus import stopwords, wordnet
from nltk.stem import WordNetLemmatizer
from nltk.tokenize import WordPunctTokenizer, TweetTokenizer

class Preprocessor:
  @staticmethod
  def denoiser(text: str) -> str:
    text = re.sub(r'@\w+', '', text) 
    text = re.sub(r'[^a-zA-Z ]', '', text)
    text = re.sub(r'https\w+', '', text)
    text = re.sub(r'http\w+', '', text)
    text = text.strip()
    text = text.lower()
    return text

  @staticmethod
  def stopwords_remover(text: str) -> str:
    matcher = re.compile(r"|".join([fr"\b{word}\b" for word in stopwords.words("english")]))
    text = " ".join(matcher.sub('', text).split())
    return text

  @staticmethod
  def lemmatizer(text: str) -> str:
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
            lemmatized_tokens.append(wordnet_lemmatizer.lemmatize(token, wordnet_tag))
            
    return ' '.join(lemmatized_tokens)
  
  @staticmethod
  def process_text(text: str) -> str:
    text = Preprocessor.denoiser(text)
    text = Preprocessor.stopwords_remover(text)
    text = Preprocessor.lemmatizer(text)
    return text