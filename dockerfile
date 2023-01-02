FROM nginx
#config

COPY docker-contextNginx/nginx.conf /etc/nginx/nginx.conf

#content
COPY ./web/html/index.html /usr/share/nginx/html/
COPY ./web/html/login.html /usr/share/nginx/html/
COPY ./web/html/register.html /usr/share/nginx/html/
COPY ./web/php/*.php /usr/share/nginx/html/
COPY ./web/assets/css/*.css /usr/share/nginx/html/
COPY ./web/assets/colors/*.css /usr/share/nginx/html/
COPY ./web/assets/js/*.js /usr/share/nginx/html/
COPY ./web/assets/js/jquery.min.js /usr/share/nginx/html/
COPY ./web/assets/js/jquery.sparkline.min.js /usr/share/nginx/html/
COPY ./web/assets/plugins/*.js /usr/share/nginx/html/
COPY ./web/assets/plugins/sidemenu/*.js /usr/share/nginx/html/

RUN apt-get update && apt-get install -y \
    php \
    php-fpm \
    php-mysqli 

RUN chown nginx:nginx /usr/share/nginx/html
RUN chmod 755 /usr/share/nginx/html
EXPOSE 8080
