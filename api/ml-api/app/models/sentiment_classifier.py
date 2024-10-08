import joblib

class ModelSentiment:
	vectorizer = None
	selector_sentiment = None
	model_sentiment = None
	
	sentiment_label_description_map = {
		0: 'negative',
		1: 'positive',
		2: 'neutral',
	}

	@staticmethod
	def _initialize():
		if ModelSentiment.vectorizer is None:
			ModelSentiment.vectorizer = joblib.load('pkl/tfidf_vectorizer.pkl')
		
		if ModelSentiment.selector_sentiment is None:
			ModelSentiment.selector_sentiment = joblib.load('pkl/selector_sentiment.pkl')
		
		if ModelSentiment.model_sentiment is None:
			ModelSentiment.model_sentiment = joblib.load('pkl/model_sentiment.pkl')
	
	@staticmethod
	def _vectorize(text: str):
		ModelSentiment._initialize()
		return ModelSentiment.vectorizer.transform([text])

	@staticmethod
	def _select_best_features(vector):
		return ModelSentiment.selector_sentiment.transform(vector)

	@staticmethod
	def predict(text: str):
		ModelSentiment._initialize()
		vector = ModelSentiment._vectorize(text)
		vector = ModelSentiment._select_best_features(vector)
		target_classes = ModelSentiment.model_sentiment.classes_

		predicted_probabilities_map = dict(zip(
			ModelSentiment.sentiment_label_description_map.values(),
			ModelSentiment.model_sentiment.predict_proba(vector)[0]
		))

		predicted_sentiment = max(predicted_probabilities_map.items(), key=lambda x: x[1])

		return predicted_sentiment