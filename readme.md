# Setup
## Clone Repository
``` bash

$ git clone git@github.com:jfcodiaz/incfile-challenge.git

```


## Enter to the clone directory
``` bash

$ cd incfile-challenge

```
## Configure
Copy the .env files, the first is for docker environment and the second is for Laravel.
``` console

$ cp .env.example .env
$ cp code/.env.example code/.env

```
## Configure code/.env
I included a endpoint for test; [POST] http://localhost:8085/random I set it for default, we can change it for the challenge URL in the code/.env with the everionment var ENDPOINT:
```
#ENDPOINT=https://atomic.incfile.com/fakepost
ENDPOINT=http://localhost/random
```
> In the case of localhost is without port, the endpoint will be consume inside the conteiner.

## Confiugure .env
In this .env file you can change the exposed ports for the services, the name of the project and the mysql root password, by default are set:
```
PROJECT_NAME=incfile
HTTP_PORT=8085
PHPMYADMIN_PORT=8036
MYSQL_PORT=3305
ROOT_PASSWORD=pass
```

## Run docker containers
``` console

$ docker-compose up -d 

```
## Enter to incfile_www conainer
```console

$ docker exec -it incfile_www bash

```
## Setup Laravel and build frontend assets
``` console

/var/www# composer install
/var/www# npm install
/var/www# php artisan migrate
/var/www# npm run dev

```

## Restart Supervisor Services
Supervisor is configured to auto start, but is necessary restart the first time, because it was started before laravel was initialize then the services are broken, with the preview step it's fixed.
``` console

/var/www# supervisorctl stop all
/var/www# supervisorctl start all

```
# Run the command
```console

/var/www# php artisan app:send-requests ${number of requests}

```
The number of requests indicated will be sent, if the request failed, it will try to send a couple of times, if the delivery fails three times, it will try again after a minute, it will try three more times and in this way until the request is accepted.

You can see the jobs db with phpmyadmin in http://localhost:8036 in the [jobs table (Request to send)](http://localhost:8036/index.php?route=/sql&server=1&db=laravel&table=jobs&pos=0) and [failed_jobs table(Request failled but it will be integrated to the jobs list again eventually)](http://localhost:8036/index.php?route=/sql&server=1&db=laravel&table=failed_jobs&pos=0), according you refresh the page the delivered requests will be disappear, the table [requests](http://localhost:8036/index.php?route=/sql&db=laravel&table=requests&pos=0) have all the request.

I build a little dashboard to see the progress of the delivered request, you can see it on http://localhost:8085


The [PR: Incfile challenge #1](https://github.com/jfcodiaz/incfile-challenge/pull/1), include all the code for the challenge out of the laravel code.
