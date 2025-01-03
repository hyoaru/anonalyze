from .interfaces import ConceptExtractionModelABC
from rake_nltk import Rake


class RakeConceptExtractionModel(ConceptExtractionModelABC):
    def __init__(self):
        super().__init__()
        self._model = Rake(min_length=1, max_length=3)

    def extract(self, text: str) -> dict:
        self._model.extract_keywords_from_text(text)
        phrase_scores = self._model.get_ranked_phrases_with_scores()

        phrase_scores_map = {
            scored_phrase[1]: scored_phrase[0] for scored_phrase in phrase_scores
        }

        return phrase_scores_map
