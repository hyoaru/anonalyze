from app.controllers.sentiment_controller import SentimentController
from app.models.machine_learning.classification_models.sentiment_classification_models.factory import (
    SentimentClassificationModelFactory,
)
from app.models.machine_learning.feature_selectors.factory import FeatureSelectorFactory
from app.models.machine_learning.text_vectorizers.factory import TextVectorizerFactory
from flask_restx import Namespace, Resource, reqparse

ns = Namespace("sentiment")

# Parsers
predict_parser = reqparse.RequestParser().add_argument(
    "text", type=str, location="json", required=True, help="Text to analyze"
)

text_vectorizer_tfidf = TextVectorizerFactory.create_tfidf()
feature_selector_chi_squared = FeatureSelectorFactory.create_chi_squared_sentiment()
sentiment_classification_model_naive_bayes = (
    SentimentClassificationModelFactory.create_naive_bayes(
        text_vectorizer=text_vectorizer_tfidf,
        feature_selector=feature_selector_chi_squared,
    )
)

sentiment_controller_naive_bayes = SentimentController(
    sentiment_classification_model=sentiment_classification_model_naive_bayes
)


# Routes
@ns.route("/predict")
class SentimentPredict(Resource):
    @ns.expect(predict_parser)
    def post(self):
        data = predict_parser.parse_args()
        text = data["text"]

        return sentiment_controller_naive_bayes.predict(text)


@ns.route("/model-info")
class SentimentModelInfo(Resource):
    def get(self):
        return sentiment_controller_naive_bayes.model_info()


@ns.route("/labels")
class SentimentLabels(Resource):
    def get(self):
        return sentiment_controller_naive_bayes.labels()
