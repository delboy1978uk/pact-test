FROM rolanddevit/php80-fpm
WORKDIR "/var/www/html"
COPY ./php/php-ini-overrides.ini /usr/local/etc/php/conf.d/99-overrides.ini
COPY ./php/ssmtp.conf /etc/ssmtp/ssmtp.conf
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --filename=composer
RUN rm composer-setup.php
RUN chown -R 1000:staff ./composer
RUN mv ./composer /usr/bin/composer
RUN echo "export PATH=$PATH:bin:vendor/bin" > /root/.bashrc
COPY ./certificates/proxyman_ca.crt /usr/local/share/ca-certificates/proxyman_ca.crt
RUN chmod 644 /usr/local/share/ca-certificates/proxyman_ca.crt && update-ca-certificates
