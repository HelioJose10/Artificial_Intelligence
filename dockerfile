FROM nginx
#config
COPY ./nginx.conf /etc/nginx/nginx.conf

#content
COPY ./*.html /usr/share/nginx/html/
#COPY ./*.css /usr/share/nginx/html/
#COPY ./*.png /usr/share/nginx/html/
#COPY ./*.js /usr/share/nginx/html/