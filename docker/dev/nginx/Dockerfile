FROM debian:jessie

RUN apt-get update && apt-get install -y \
    nginx \
    && ln -sf /proc/1/fd/1 /var/log/nginx/access.log \
    && ln -sf /proc/1/fd/2 /var/log/nginx/error.log

# Add config files
COPY nginx.conf /etc/nginx/nginx.conf
COPY upstream.conf /etc/nginx/sites-available/upstream.conf
COPY android-academy.conf /etc/nginx/sites-available/android-academy.conf
# ssl
RUN mkdir /etc/nginx/ssl
COPY ssl.crt /etc/nginx/ssl/ssl.crt
COPY ssl.key /etc/nginx/ssl/ssl.key

RUN ln -s /etc/nginx/sites-available/android-academy.conf /etc/nginx/sites-enabled/android-academy
RUN rm /etc/nginx/sites-enabled/default
RUN rm /etc/nginx/sites-available/default

WORKDIR /var/www/android-academy

CMD ["nginx"]