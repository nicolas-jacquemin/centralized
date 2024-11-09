#!/bin/sh

check_mysql_connection() {
    telnet $DB_HOST $DB_PORT > /dev/null 2>&1
    return $?
}

echo "Clearing and caching config..."
php artisan config:clear
php artisan config:cache
php artisan route:clear
php artisan view:clear

echo "Linking storage..."
php artisan storage:link || true

echo "Checking MySQL connection..."
mysql_attempts=0
max_attempts=5
while ! check_mysql_connection; do
    mysql_attempts=$((mysql_attempts+1))
    if [ $mysql_attempts -ge $max_attempts ]; then
        echo "Unable to connect to MySQL after $max_attempts attempts."
        exit 1
    fi
    echo "MySQL connection failed. Retrying in 5 seconds..."
    sleep 5
done
echo "MySQL connection established."

php artisan migrate --force
php artisan db:seed --force

if [ -z "$APP_KEY" ]; then
    echo "Generating application key..."
    php artisan key:generate --force
fi

echo "Starting queue worker..."
service supervisor start
supervisorctl start "worker:*"
supervisorctl start "schedule"

echo "Prerequisites are complete."
echo "Starting Octane server..."
exec php artisan octane:frankenphp
