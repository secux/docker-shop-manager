#!/bin/bash

echo "Starting PHP Standalone webserver for manager GUI"

if [ -z "$GIT_CREDENTIALS" ] 
then
  echo "GIT_CREDENTIALS envrionment variable not set"
  exit 64
fi

echo -e "$GIT_CREDENTIALS" > $HOME/.netrc
chmod 600 /$HOME/.netrc

php -S 0.0.0.0:80 -t /app
