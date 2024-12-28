FROM nginx:1.27.3-alpine

RUN apk update && apk add vim curl bash

COPY ./conf/default.production.conf /etc/nginx/conf.d/default.conf
COPY ./etc/hosts.production.conf /etc/hosts.conf
RUN cat /etc/hosts.conf >> hosts

CMD ["nginx", "-g", "daemon off;"]
