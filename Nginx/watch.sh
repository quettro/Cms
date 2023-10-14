#!/bin/bash
###########

while true
do
  inotifywait --event create,modify,delete,move --quiet /var/www/html/storage/app/conf.d 2> /dev/null
  if [ $? -eq 0 ]
  then
    nginx -t
    if [ $? -eq 0 ]
    then
      echo "Detected Nginx Configuration Change"
      echo "Executing: nginx -s reload"
      nginx -s reload
    fi
  fi
done
