import os
from app import create_app, initalize_nltk_resource

os.chdir(os.path.dirname(os.path.abspath(__file__)))
initalize_nltk_resource()
app = create_app()
