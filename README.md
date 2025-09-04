# Anonalyze: An NLP-Enhanced and ML-Driven Platform for Sentiment and Insight Extraction

https://github.com/user-attachments/assets/5daea2f7-081d-4c4c-8b92-f0b65ba805c1

Anonalyze is a **research-driven AI, ML, and NLP-powered web platform** developed as part of an undergraduate thesis project. The platform focuses on analyzing **anonymous user-generated content** through **Machine Learning (ML)** and **Natural Language Processing (NLP)** techniques.  

- **Sentiment Analysis** (positive, negative, neutral)  
- **Emotion Classification** (joy, sadness, anger, fear, love, surprise)  
- **Keyword & Keyphrase Extraction** (RAKE algorithm)  
- **Discussion Summarization** (LLM-based summaries)  

## Model Training Process
This project utilizes a **sentiment and emotion classification model** using **Machine Learning (ML)** and **Natural Language Processing (NLP)**. The system analyzes text and predicts:
- **Sentiment**: positive, negative, or neutral
- **Emotion**: sadness, joy, love, anger, fear, or surprise

The core model utilizes a **Multinomial Naive Bayes classifier**, trained on a large dataset of Twitter messages.

**Model Training Process**: 
- Repository: https://github.com/hyoaru/anonalyze-process
- [See the training process live](https://htmlpreview.github.io/?https://github.com/hyoaru/anonalyze-process/blob/master/models/sentiment-emotion-classification/model-training-process.html)

## Tech Stack
- **Frontend:** React + Typescript + Tanstack
- **Backend API:** Laravel (PHP) + Flask (Python)  
- **Machine Learning:** Python (scikit-learn, NLTK, Pandas, NumPy)  
- **Containerization:** Docker & Docker Compose  
- **Database:** MySQL  

## Setup Guide  

Follow the steps below to run the project in development mode:  

### 1. Clone the Repository  
```bash
git clone https://github.com/hyoaru/anonalyze.git
cd anonalyze
```

### 2. Environment Setup
```bash
cat .env.example > .env
cat ./client/web/.env.example > .env
cat ./api/core/.env.example > .env   # Make sure to populate GEMINI_API key
cat ./api/ml/.env.example > .env
```

### 3. Run Docker Compose
```bash
sudo docker compose -f docker-compose.development.yaml up
```

### 4. Configure Core API
Enter the container:
```bash 
docker exec -it anonalyze_api_core bash
```
Run the following commands inside:
```bash
php artisan key:generate
php artisan migrate --database=mysql
php artisan db:seed
```

## Ports and Access
| Service                     | URL / Hostname                                 | Description                                                             |
| --------------------------- | ---------------------------------------------- | ----------------------------------------------------------------------- |
| Web Client (React)          | [http://localhost:8000](http://localhost:8000) | Main web interface                                                      |
| Core API (Laravel)          | [http://localhost:8002](http://core.localhost) | Backend API for application logic                                       |
| ML API (Flask)              | [http://localhost:8003](http://ml.localhost)   | Machine learning microservice (sentiment, emotion, keywords, summaries) |
| Database Admin (phpMyAdmin) | [http://localhost:7999](http://dba.localhost)  | MySQL database administration                                           |
| SMTP Mailhog                | [http://localhost:7998](http://smtp.localhost) | Local mail testing (emails capture)                                     |


## Project Structure
```
.
├── api
│ ├── core-api # Laravel backend for core application logic and REST API
│ │ ├── app/ # Controllers, Models, Services, Repositories, Policies
│ │ ├── database/ # Migrations, Seeders, Factories
│ │ ├── routes/ # API and web routes
│ │ ├── config/ # Laravel configurations
│ │ ├── tests/ # Unit and feature tests
│ │ ├── artisan # Laravel CLI
│ │ └── public/ # Public assets and index.php
│ │
│ └── ml-api # Python ML microservice
│ ├── app/
│ │ ├── api/ # API namespaces (emotion, sentiment, concept, summary)
│ │ ├── controllers/ # REST controllers for ML endpoints
│ │ ├── configurations/ # Model and feature selector configs
│ │ ├── models/ # ML models (Naive Bayes, RAKE, TF-IDF, Chi-squared)
│ │ ├── utils/ # Preprocessing utilities (denoising, stopwords, lemmatization)
│ │ └── data/pkl/ # Serialized models, vectorizers, and selectors
│ ├── main_development.py
│ ├── main_production.py
│ └── requirements.txt
│
├── client
│ └── web # React frontend
│ ├── public/ # Public assets
│ ├── src/ # Components, pages, and logic
│ ├── index.html
│ ├── package.json
│ └── Dockerfile
│
├── docker-compose.development.yaml
├── docker-compose.production.yaml
├── .env.example
└── README.md
```

## Features
- Anonymous Posting – Encourages open communication without fear of exposure.
- ML-Driven Sentiment Analysis – Classifies posts as positive, neutral, or negative.
- Emotion Classification – Identifies six core emotions: joy, sadness, anger, fear, love, surprise.
- Keyword Extraction – Highlights important discussion terms using the RAKE algorithm.
- Thread Summarization – Uses LLMs to condense long threads into key takeaways.
- Dashboard & Visualization – Real-time insights and analytics.

## Academic Context
This project was developed as an undergraduate thesis to demonstrate the application of NLP and ML in processing user-generated content. It aims to contribute to research in machine learning, sentiment analysis, emotion detection, and automated summarization, while also showcasing a practical implementation through a web-based system.
