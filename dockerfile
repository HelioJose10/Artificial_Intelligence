FROM nginx:latest
#config
COPY ./nginx.conf /etc/nginx/nginx.conf

#content
COPY ./web/html/*.html /usr/share/nginx/html/
COPY ./web/assets/css/*.css /usr/share/nginx/html/
COPY ./web/assets/colors/*.css /usr/share/nginx/html/
COPY ./web/assets/images/brand/* /usr/share/nginx/html/
COPY ./web/assets/js/*.js /usr/share/nginx/html/
COPY ./web/assets/plugins/*.js /usr/share/nginx/html/
COPY ./web/assets/plugins/sidemenu/*.js /usr/share/nginx/html/

EXPOSE 8080
