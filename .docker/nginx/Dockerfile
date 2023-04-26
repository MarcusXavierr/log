FROM nginx:1.20.2-alpine

RUN ["apk", "add", "vim"]

RUN rm /etc/nginx/conf.d/default.conf
COPY ./sites/* /etc/nginx/conf.d/

WORKDIR /var/www/
