import nltk
from flask import Flask
from dotenv import load_dotenv

# App imports
from app.api.namespaces.sentiment import ns as ns_sentiment
from app.api.namespaces.emotion import ns as ns_emotion
from app.api.namespaces.concept import ns as ns_concept
from app.api.namespaces.summary import ns as ns_summary

# Import instances
from app.instances import api, cors


def create_app():
    load_dotenv()
    app = Flask(__name__)

    # Namespaces
    api.add_namespace(ns_sentiment)
    api.add_namespace(ns_emotion)
    api.add_namespace(ns_concept)
    api.add_namespace(ns_summary)

    # Instances lazy loading
    api.init_app(app, version="1.1", title="Anonalyze ML API")
    cors.init_app(app)

    return app


def initalize_nltk_resource():
    nltk_resources = [
        "stopwords",
        "wordnet",
        "punkt",
        "punkt_tab",
        "omw-1.4",
        "averaged_perceptron_tagger",
        "averaged_perceptron_tagger_eng",
        "maxent_ne_chunker",
        "words",
        "maxent_ne_chunker_tab",
        "tagsets",
        "tagsets_json",
    ]

    for resource in nltk_resources:
        nltk.download(resource)
