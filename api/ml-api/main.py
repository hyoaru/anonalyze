from app import create_app, initalize_nltk_resource

if __name__ == '__main__':
    initalize_nltk_resource()
    app = create_app()
    app.run(debug=True)