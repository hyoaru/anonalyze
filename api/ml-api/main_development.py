from app import create_app, initalize_nltk_resource

initalize_nltk_resource()
app = create_app()

if __name__ == "__main__":
    app.run(host="0.0.0.0", port=8003, debug=True)
