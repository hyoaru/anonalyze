from flask_restx import Resource, Namespace, reqparse
from rake_nltk import Rake

# App imports
from app.utils.preprocessor import Preprocessor

ns = Namespace('concept')

parser = (
    reqparse.RequestParser()
    .add_argument(
        'texts', type=list, location='json', default=[], 
        action="append", required=True, help='Text to analyze') )
    
@ns.route('/extract')
class ExtractConcept(Resource):
    @ns.expect(parser)
    def post(self):
        data = parser.parse_args()
        texts = data['texts'][0]

        r = Rake(min_length=1, max_length=3)
        r.extract_keywords_from_sentences(texts)
        phrase_scores = r.get_ranked_phrases_with_scores()
        phrase_scores_map = {scored_phrase[1]:scored_phrase[0] for scored_phrase in phrase_scores}

        return {"data": {'texts': texts, "extracted_concepts": phrase_scores_map}}

@ns.route('/model-info')
class ModelInfo(Resource):
	def get(self):
		return {
			"algorithm": "Rapid Automatic Extraction Algorithm",
		}

@ns.route('/health')
class HealthCheck(Resource):
	def get(self):
		return {'status': 'ok'}