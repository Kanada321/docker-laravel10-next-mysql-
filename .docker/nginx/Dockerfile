FROM nginx:alpine
# UID を www-data ユーザーの UID（通常は 33） に設定
RUN apk add --no-cache shadow && \
    usermod -u 1000 nginx && \
    groupmod -g 1000 nginx

WORKDIR /var/www/application
