#!/bin/bash

#composer install

>&2 echo "You have to enter your mysql password now "

mysql -u root -p -D mvc < ./db.sql;

>&2 echo "Your application is now ready to serve at http://localhost:8000/ "

php -S localhost:8000