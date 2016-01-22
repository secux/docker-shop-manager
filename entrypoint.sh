#!/bin/sh

echo "Starting PHP Standalone webserver for manager GUI"

php -S 0.0.0.0:80 -t /app
