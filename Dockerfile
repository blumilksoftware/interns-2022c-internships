FROM node:16-alpine3.11

WORKDIR /internship

COPY package*.json ./

RUN npm install

COPY . .

RUN npm run build

EXPOSE 8080

CMD ["npm", "run", "serve"]
