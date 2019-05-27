Requirements
------------

  - [PHP](https://secure.php.net/) >= 7.1.3
  - [MySQL](https://www.mysql.com/) 5.7

#### For development

  - [Composer](https://getcomposer.org/)
  - [Docker](https://www.docker.com/)
    - [Docker Compose](https://docs.docker.com/compose/)
  - [SQLite](https://www.sqlite.org/index.html)
    - `php-sqlite3` extension

Setting up a Local Development Environment
------------------------------------------

### Create the Docker `development` Network

    docker network create development

### Run the `jwilder/nginx-proxy` Container

    docker run -d -p 80:80 --network development --restart unless-stopped --volume /var/run/docker.sock:/tmp/docker.sock:ro --name dev-proxy jwilder/nginx-proxy

### Configure the Hostnames

Add the following entry to `/etc/hosts`:

    127.0.0.1  chriskankiewicz.local chriskankiewicz-dot-com-mysql chriskankiewicz-dot-com-redis

### Set Environment Variables

To set up your local environment variables copy `.env.example` to `.env` then
generate your application key.

    cp .env.example .env
    artisan key:generate

Once done you must set the remaining variables in the `.env` file.

### Start the Docker Environment

To build and start the containers on your system for the first time run the
following from the project's root directory:

    docker-compose up -d --build

### Initialize the Database

Run the migrations and seed the database.

    docker-compose exec php artisan migrate

### Accessing the Development Site

You can access the development site at <http://chriskankiewicz.local>.
