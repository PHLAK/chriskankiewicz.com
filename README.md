<p align="center">
    <img src="chris-kankiewicz.svg" alt="Chris Kankiewicz" width="50%">
</p>

<p align="center">
    <a href="https://github.com/PHLAK/chriskankiewicz.com/blob/master/LICENSE"><img src="https://img.shields.io/github/license/phlak/chriskankiewicz.com?style=flat-square" alt="License"></a>
    <a href="https://github.com/PHLAK/chriskankiewicz.com/actions"><img src="https://img.shields.io/github/actions/workflow/status/PHLAK/chriskankiewicz.com/test-suite.yaml?style=flat-square" alt="Build Status"></a>
    <a href="https://www.ChrisKankiewicz.com"><img src="https://img.shields.io/badge/created_by-Chris%20Kankiewicz-319795.svg?style=flat-square" alt="Author"></a>
</p>

---

Requirements
------------

  - [PHP](https://secure.php.net/)
  - [MySQL](https://www.mysql.com/)
  - [Node.js](https://nodejs.org)

#### For development

  - [Composer](https://getcomposer.org/)
  - [Docker](https://www.docker.com/)
    - [Docker Compose](https://docs.docker.com/compose/)
  - [SQLite](https://www.sqlite.org/index.html) (i.e. `php-sqlite3` extension)

Setting up a Local Development Environment
------------------------------------------

### Configure the Hostnames

Add the following entry to `/etc/hosts`:

    127.0.0.1  chriskankiewicz.local mysql redis

### Set Environment Variables

To set up your local environment variables copy `.env.example` to `.env` then
generate your application key.

    cp .env.example .env
    artisan key:generate

Once done you must set the remaining variables in the `.env` file.

### Start the Docker Environment

To build and start the containers on your system for the first time run the
following from the project's root directory:

    docker-compose up -d

## Install PHP dependencies

    composer install

## Install JavaScript Assets

    npm install

### Initialize and Seed the Database

    artisan migrate:fresh --seed

### Accessing the Development Site

You can access the development site at <http://chriskankiewicz.local>.

## Debugging

### Laravel Telescope

[Laravel Telescope](https://laravel.com/docs/telescope) is included in local
environments for debugging. Telescope provides insight into the requests coming
into your application, exceptions, log entries, database queries, queued jobs,
mail, notifications, cache operations, scheduled tasks, variable dumps and more.

You can access Telescope via <http://chriskankiewicz.local/telescope>

### Tailing Application Logs

    docker-compose logs --follow --tail 20 app
