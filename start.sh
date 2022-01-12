# start.sh
# This script starts the PHP CLI web server and runs the yarn serve command from
# the frontend directory.

cd backend
composer install && composer update 
cd web && php -S localhost:8080 &

cd ../frontend
yarn install && yarn serve
