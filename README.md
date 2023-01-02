# PROJETO SISTEMAS DISTRIBUIDOS

Run this commands in order to launch the project

#to create the volume
(only do this once per host machine)

>docker volume create --name=dataA
>docker volume create --name=dataB

#to build 

>docker-compose build

#to run 

>docker-compose -p projsistemas  up


To access databases directly use terminal 

>docker ps

>docker exec -it [db container id] bash

>mysql -u root -p

>password

###
RUN docker-php-ext-install mysqli

--CREATE USER 'replication_user'@'%' IDENTIFIED BY 'password';
--GRANT REPLICATION SLAVE ON *.* TO 'replication_user'@'%';
--FLUSH TABLES WITH READ LOCK;
--SHOW MASTER STATUS;
--UNLOCK TABLES;