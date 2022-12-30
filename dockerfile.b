FROM mysql:latest

ENV MYSQL_ROOT_PASSWORD=password

COPY ./createsB.sql /docker-entrypoint-initdb.d/

