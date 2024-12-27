from flask_restx import Resource, Namespace, reqparse
from app.models.concept_extraction_models.rake_concept_extraction_model import (
    RakeConceptExtractionModel,
)
from app.models.concept_extraction_models.interfaces import ConceptExtractionModelABC

ns = Namespace("concept")

parser = reqparse.RequestParser().add_argument(
    "texts",
    type=list,
    location="json",
    default=[],
    action="append",
    required=True,
    help="List of text to analyze",
)


@ns.route("/extract")
class ConceptExtract(Resource):
    def __init__(self, *args, **kwargs):
        super().__init__(*args, **kwargs)

        self._concept_extraction_model: ConceptExtractionModelABC = (
            RakeConceptExtractionModel()
        )

    @ns.expect(parser)
    def post(self):
        data = parser.parse_args()
        texts = data["texts"][0]

        extracted_concepts = self._concept_extraction_model.extract(texts)
        return {"data": {"texts": texts, "extracted_concepts": extracted_concepts}}


@ns.route("/model-info")
class ModelInfo(Resource):
    def get(self):
        return {
            "algorithm": "Rapid Automatic Extraction Algorithm",
        }
