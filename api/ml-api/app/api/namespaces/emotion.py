from flask_restx import Resource, Namespace, reqparse
from app.models.emotion_classifier import ModelEmotion
from app.utils.preprocessor import Preprocessor

ns = Namespace("emotion")

parser = reqparse.RequestParser().add_argument(
    "text", type=str, location="json", required=True, help="Text to analyze"
)


@ns.route("/predict")
class PredictEmotion(Resource):
    @ns.expect(parser)
    def post(self):
        data = parser.parse_args()
        text = data["text"]

        preprocessed_text = Preprocessor.process_text(text)
        predicted_value = ModelEmotion.predict(preprocessed_text)

        return {"data": {"text": text, "predicted_value": predicted_value}}


@ns.route("/model-info")
class ModelInfo(Resource):
    def get(self):
        return {
            "model_version": "v1.0",
            "algorithm": "Multinomial Naive Bayes",
            "trained_on": "Kaggle Twitter dataset",
        }


@ns.route("/health")
class HealthCheck(Resource):
    def get(self):
        return {"status": "ok"}


@ns.route("/labels")
class EmotionLabels(Resource):
    def get(self):
        return {
            "labels": [
                "sadness",
                "joy",
                "love",
                "anger",
                "fear",
                "surprised",
            ]
        }
