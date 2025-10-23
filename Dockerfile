# Alpine + Apache + PHP 8.2 (mod_php)
FROM alpine:3.20

# Install Apache and PHP 8.2 with MySQL PDO
RUN apk add --no-cache \
    apache2 \
    php82 \
    php82-apache2 \
    php82-pdo_mysql \
    php82-mysqli \
    php82-session \
    php82-opcache \
    curl \
  && mkdir -p /run/apache2

# Ensure DirectoryIndex includes index.php (PHP module config is provided by php82-apache2)
RUN echo "\nDirectoryIndex index.php index.html\n" >> /etc/apache2/httpd.conf

# Workdir = default Alpine Apache doc root
WORKDIR /var/www/localhost/htdocs

# Copy application source
COPY app/ ./

EXPOSE 80

# Run Apache in foreground
CMD ["httpd", "-D", "FOREGROUND"]
