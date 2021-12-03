# Setup

## Configure
Copy the .env files, the first is for docker environment and the second is for Laravel
``` bash
$ cp .env.example .env
$ cp code/.env.example code/.env
```
## Configure code/.env
I include a endpoit for test POST http://localhost:8085/random but I set it for default, we can change it for the challenge URL in the .env with the everionment var ENDPOINT

## Run docker containers
``` bash

$ docker-composer up -d

$ docker exec -it incfile_www bash

/var/www# composer install
/var/www# php artisan migrate

```

# Run the command
``` bash

/var/www# php artisan app:send-requests {number of requests}

```

You can see the jobs db with phpmyadmin in http://localhost:8086 in the [jobs](http://localhost:8036/index.php?route=/sql&server=1&db=laravel&table=jobs&pos=0) and [failed_jobs](http://localhost:8036/index.php?route=/sql&server=1&db=laravel&table=failed_jobs&pos=0) tables, according you refresh the page the delivered jobs will be disappear


