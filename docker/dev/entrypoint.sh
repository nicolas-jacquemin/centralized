#!/bin/sh

php artisan storage:link || true
exec php artisan octane:frankenphp --watch
