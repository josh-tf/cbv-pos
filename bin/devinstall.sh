#!/bin/sh

npm install --only=dev
composer install
php bin/install.php translations develop
bower install --allow-root
bin/gendocs.sh

