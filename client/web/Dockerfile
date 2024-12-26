FROM node:20-slim
RUN apt-get update && apt-get install -y curl bash
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
CMD ["npm", "run", "build"]
