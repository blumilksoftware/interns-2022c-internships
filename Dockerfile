FROM node:lts-alpine

WORKDIR /intenrship

COPY package*.json ./

RUN npm install

EXPOSE 8080

CMD ["npm", "run", "serve"]