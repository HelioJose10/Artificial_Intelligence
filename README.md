# PROJETO SISTEMAS DISTRIBUIDOS - João Pires, nº20200459

Run this commands in order to launch the project

#to create the volume
(only do this once per host machine)

>docker volume create --name=dataA
>docker volume create --name=dataB

#to build 

>docker-compose build

#to run 

>docker-compose -p projsistemas  up


#To access databases 

>mysql -u root -p

>password

#to set replication on 

>open mysql dbA and get log_file and log_pos

>open mysql dbB and run createsB.sql code but input active log_file and log_pos values

>START SLAVE;

#to open main project page, might take some time to load conf files

>localhost:8080/


