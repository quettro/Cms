#!/bin/bash
###########

sh -c "/usr/local/watch.sh &"
exec /docker-entrypoint.sh "$@"
