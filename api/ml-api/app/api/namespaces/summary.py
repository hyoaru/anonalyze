from flask_restx import Namespace, Resource, reqparse

from app.controllers.summary_controller import SummaryController
from app.models.llm_summarization_models.factory import LlmSummarizationModelFactory
from app.models.llm_summarization_models.interfaces import LlmSummarizationModelABC

ns = Namespace("summary")

# Parsers
summary_parser = reqparse.RequestParser().add_argument(
    "text", type=str, location="json", required=True, help="Text to summarize"
)

gemini_llm_summarization_model: LlmSummarizationModelABC = (
    LlmSummarizationModelFactory.create_gemini()
)
gemini_summarization_controller = SummaryController(
    summarization_model=gemini_llm_summarization_model
)


# Routes
@ns.route("/summarize")
class Summarize(Resource):
    @ns.expect(summary_parser)
    def post(self):
        data = summary_parser.parse_args()
        text = data["text"]

        return gemini_summarization_controller.summarize(text)


@ns.route("/model-info")
class ModelInfo(Resource):
    def get(self):
        return gemini_summarization_controller.model_info()
