FROM php:7.2-cli
COPY . /app
WORKDIR /app
CMD ["php", "bin/run", "app:factory"]
