# PROJETO SISTEMAS DISTRIBUIDOS

Run this commands in order to launch the project

#to create the volume
(only do this once per host machine)

docker volume create --name=dataA
docker volume create --name=dataB

#to build 

docker-compose build

#to run 

docker-compose up