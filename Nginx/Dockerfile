FROM nginx:1.23

RUN apt-get update && apt-get install -y --no-install-recommends apt-utils inotify-tools

COPY ./watch.sh /usr/local/watch.sh
COPY ./docker-entrypoint.sh /usr/local/docker-entrypoint.sh

RUN chmod +x /usr/local/watch.sh
RUN chmod +x /usr/local/docker-entrypoint.sh

ENTRYPOINT ["/usr/local/docker-entrypoint.sh"]

CMD ["nginx", "-g", "daemon off;"]
