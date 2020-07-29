#  My Test Task

A basic LAMP stack environment built using Docker Compose. It consists of the following:

* PHP 7.2
* Apache
* MySQL
* Docker & Docker Compose


##  Installation
 
* Clone this repository on your local computer
* Run the `docker-compose up -d --build`.

#### COMANDS

```shell
git clone https://github.com/Frishka/testTaskFacebook.git

cd testTaskFacebook/

docker-compose up -d --build

docker exec -it lamp-php72 bash

composer install

// visit localhost
```
My code is in the /src directory.

