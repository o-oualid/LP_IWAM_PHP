FROM phpstorm/php-apache
COPY xdebug.ini "${PHP_INI_DIR}/conf.d"
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN docker-php-ext-enable mysqli pdo pdo_mysql
