FROM nginx:alpine
RUN mkdir -p /var/www/html
COPY nginx/default.conf /etc/nginx/conf.d/default.conf
COPY src/ /var/www/html/