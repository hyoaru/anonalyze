import os
import nltk
from flask import Flask

# App imports
from app.models.sentiment_classifier import ModelSentiment
from app.models.emotion_classifier import ModelEmotion
from app.api.namespaces.sentiment import ns as ns_sentiment
from app.api.namespaces.emotion import ns as ns_emotion
from app.api.namespaces.concept import ns as ns_concept

# Import instances
from app.instances import api

def create_app():
    initalize_resource()    

    ModelSentiment._initialize()
    ModelEmotion._initialize()
    
    app = Flask(__name__)

    # Namespaces
    api.add_namespace(ns_sentiment)
    api.add_namespace(ns_emotion)
    api.add_namespace(ns_concept)

    # Instances lazy loading
    api.init_app(app)

    return app

def initalize_resource():
    path = nltk.data.find('corpora')
    nltk_resource = ['stopwords', 'wordnet']
    for resource in nltk_resource:
        if f"{resource}.zip" not in os.listdir(path):
            download_nltk_resource('stopwords')
            download_nltk_resource('wordnet')