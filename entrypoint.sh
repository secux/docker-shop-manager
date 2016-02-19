#!/bin/bash

### Set composer configurations from envrionment ###

# read relevant environment variables
COMPOSER_CONFIG=$(set | grep COMPOSER_CONFIG)

while read -r line; do
  # split var and value by =
  name=${line%=*}
  val=${line#*=}
  # clear quotes from start/end
  val="${val%\'}"
  val="${val#\'}"

  # split value by :
  key=${val%:*}
  value=${line#*:}

  echo "Setting composer config [$key]=$value"

  /usr/local/bin/composer.phar config -g $key $value

done <<< "$COMPOSER_CONFIG"


echo "Starting PHP Standalone webserver for manager GUI"

php -S 0.0.0.0:80 -t /app
