# Setup
``` bash

$ cp .env.example .env

$ docker-composer up

$ docker exec -it incfile_www bash

/var/www# cp .env.example .env
/var/www# composer install
/var/www# php artisan key:generate

```