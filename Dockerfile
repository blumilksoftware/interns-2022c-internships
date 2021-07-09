FROM node:lts-alpine

WORKDIR /internship

COPY package*.json ./

RUN npm install

EXPOSE 8080

CMD ["npm", "run", "serve"]