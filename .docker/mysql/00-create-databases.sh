#!/usr/bin/env bash
set -o errexit -o pipefail

mysql --user root << SQL
    CREATE DATABASE IF NOT EXISTS testing;

    GRANT ALL PRIVILEGES ON testing.* TO '${MYSQL_USER}'@'%';
    GRANT ALL PRIVILEGES ON \`testing_test_%\`.* TO '${MYSQL_USER}'@'%';
SQL
