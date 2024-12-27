from app.controllers.emotion_controller import EmotionController
from app.models.machine_learning.classification_models.emotion_classification_models.factory import (
    EmotionClassificationModelFactory,
)
from app.models.machine_learning.feature_selectors.factory import FeatureSelectorFactory
from app.models.machine_learning.text_vectorizers.factory import TextVectorizerFactory
from flask_restx import Namespace, Resource, reqparse

ns = Namespace("emotion")

# Parsers
predict_parser = reqparse.RequestParser().add_argument(
    "text", type=str, location="json", required=True, help="Text to analyze"
)

text_vectorizer_tfidf = TextVectorizerFactory.create_tfidf()
feature_selector_chi_squared = FeatureSelectorFactory.create_chi_squared_emotion()
emotion_classification_model_naive_bayes = (
    EmotionClassificationModelFactory.create_naive_bayes(
        text_vectorizer=text_vectorizer_tfidf,
        feature_selector=feature_selector_chi_squared,
    )
)

emotion_controller_naive_bayes = EmotionController(
    emotion_classification_model=emotion_classification_model_naive_bayes
)


# Routes
@ns.route("/predict")
class EmotionPredict(Resource):
    @ns.expect(predict_parser)
    def post(self):
        data = predict_parser.parse_args()
        text = data["text"]

        return emotion_controller_naive_bayes.predict(text)


@ns.route("/model-info")
class EmotionModelInfo(Resource):
    def get(self):
        return emotion_controller_naive_bayes.model_info()


@ns.route("/labels")
class EmotionLabels(Resource):
    def get(self):
        return emotion_controller_naive_bayes.labels()
