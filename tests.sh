# tests.sh
# This script runs the tests for the backend API.

cd backend && php ./vendor/bin/codecept run api ./tests/api/ProductCest.php 
