import joblib

class ModelEmotion:
  vectorizer = None
  selector_emotion = None
  model_emotion = None
  
  emotion_label_description_map = {
	0: 'sadness',
    1: 'joy',
    2: 'love',
    3: 'anger',
    4: 'fear',
    5: 'surprised',
  }

  @staticmethod
  def _initialize():
    if ModelEmotion.vectorizer is None:
      ModelEmotion.vectorizer = joblib.load('pkl/tfidf_vectorizer.pkl')
    
    if ModelEmotion.selector_emotion is None:
      ModelEmotion.selector_emotion = joblib.load('pkl/selector_emotion.pkl')
    
    if ModelEmotion.model_emotion is None:
      ModelEmotion.model_emotion = joblib.load('pkl/model_emotion.pkl')
  
  @staticmethod
  def _vectorize(text: str):
    ModelEmotion._initialize()
    return ModelEmotion.vectorizer.transform([text])

  @staticmethod
  def _select_best_features(vector):
    return ModelEmotion.selector_emotion.transform(vector)

  @staticmethod
  def predict(text: str):
    ModelEmotion._initialize()
    vector = ModelEmotion._vectorize(text)
    vector = ModelEmotion._select_best_features(vector)
    
    return (
      ModelEmotion
      .emotion_label_description_map
      .get(ModelEmotion.model_emotion.predict(vector)[0]))