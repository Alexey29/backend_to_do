FROM nginx:1.13.7

RUN sed -i 's/user *nginx;/user www-data;/g' /etc/nginx/nginx.conf

COPY default.conf /etc/nginx/conf.d/default.conf
