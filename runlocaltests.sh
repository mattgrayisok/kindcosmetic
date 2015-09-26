#!/bin/bash
rm storage/testing_stub.sqlite
touch storage/testing_stub.sqlite
php artisan migrate --database="sqlite_setup" --env="testing"
php artisan migrate:refresh --database="sqlite_setup" --env="testing" --seed
./vendor/bin/codecept run
