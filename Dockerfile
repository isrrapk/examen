FROM nginx

COPY avana /usr/share/nginx/html

COPY config/webapp.conf /etc/nginx/conf.d

CMD ["nginx", "-g", "daemon off;"]
