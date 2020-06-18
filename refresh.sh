#!/usr/bin/env bash

echo "Rolling back DB..."

php artisan migrate:reset

echo "Migrating DB..."

php artisan migrate

echo "Seeding DB..."

php artisan db:seed

echo "Initializing Laravel:Passport..."

php artisan passport:install

echo "Refreshing DB success!"
