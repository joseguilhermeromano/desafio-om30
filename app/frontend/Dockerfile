# Estágio de desenvolvimento
FROM node:21.1.0-alpine as develop

WORKDIR /app

RUN apk add --no-cache yarn

COPY package*.json ./
RUN yarn global add @quasar/cli
COPY yarn.lock ./
COPY . .

RUN yarn
RUN quasar build
