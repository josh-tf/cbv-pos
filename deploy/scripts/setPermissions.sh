cd /app
ln -s /app/*[^public] /var/www && rm -rf /var/www/html && ln -nsf /app/public /var/www/html
chmod 755 /app/public/uploads && chown -R www-data:www-data /app/public /app/application
