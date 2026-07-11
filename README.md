<p align="center">
    <img src="chris-kankiewicz.svg" alt="Chris Kankiewicz" width="50%">
</p>

<p align="center">
    <a href="https://github.com/PHLAK/chriskankiewicz.com/blob/master/LICENSE"><img src="https://img.shields.io/github/license/phlak/chriskankiewicz.com?style=flat-square" alt="License"></a>
    <a href="https://github.com/PHLAK/chriskankiewicz.com/actions"><img src="https://img.shields.io/github/actions/workflow/status/PHLAK/chriskankiewicz.com/test-suite.yaml?style=flat-square" alt="Build Status"></a>
    <a href="https://www.ChrisKankiewicz.com"><img src="https://img.shields.io/badge/created_by-Chris%20Kankiewicz-319795.svg?style=flat-square" alt="Author"></a>
</p>

--

<p align="center">
    Home page of Chris Kankiewicz.
</p>

![ChrisKankiewicz.com Screenshot](screenshot.png)

Requirements
------------

  - [PHP](https://secure.php.net/)
  - [Node.js](https://nodejs.org/) (npm)
  - [Composer](https://getcomposer.org/)
  - [Docker](https://www.docker.com/)
    - [Docker Compose](https://docs.docker.com/compose/)

Setting up a Local Development Environment
------------------------------------------

### Set Environment Variables

To set up your local environment variables copy `.env.example` to `.env` and
set the required values.

    cp .env.example .env

At minimum, set a valid `GITHUB_TOKEN` for fetching project data from GitHub.

### Install Dependencies

    make dev

Or manually

    composer install
    npm install

### Start the Docker Environment

To build and start the containers on your system for the first time run the
following from the project's root directory:

    docker compose up -d

This will start the application and Valkey containers.

### Accessing the Development Site

You can access the development site at <http://localhost>.

License
-------

This project is licensed under the [Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International License](https://creativecommons.org/licenses/by-nc-sa/4.0/).
