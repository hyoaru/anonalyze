import os
from app import create_app, initalize_nltk_resource

os.chdir(os.path.dirname(os.path.abspath(__file__)))

if __name__ == "__main__":
    initalize_nltk_resource()
    app = create_app()
    app.run(host="0.0.0.0", port=8003, debug=True)
