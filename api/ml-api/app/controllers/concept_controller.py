from app.models.concept_extraction_models.interfaces import ConceptExtractionModelABC
from typing import Any


class ConceptController:
    def __init__(self, concept_extraction_model: ConceptExtractionModelABC):
        self._concept_extraction_model: Any = concept_extraction_model

    def extract_from_text_list(self, text_list: list[str]):
        return self._concept_extraction_model.extract(text_list)

    def get_model_info(self):
         # TODO: implement get model info
