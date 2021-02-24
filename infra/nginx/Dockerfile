FROM node:15.9.0-alpine3.10 as app-builder

RUN apk --update --no-cache add yarn

WORKDIR /app

COPY    ./webpack.config.js .
COPY    ./package.json .
COPY    ./yarn.lock .
COPY    ./assets ./assets

RUN yarn install ; yarn build

FROM nginx:1.19.6-alpine

COPY --from=app-builder /app/public/build /usr/share/nginx/html/build
COPY ./infra/nginx/nginx.conf /etc/nginx/conf.d/nginx.conf
