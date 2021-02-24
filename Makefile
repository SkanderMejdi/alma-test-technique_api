PHP_EXEC := docker-compose exec -T php
TARGET := alma-test-technique_api
 
build:
	docker build -t $(TARGET) .

init:
	cp .env.dist .env

start:
	docker-compose up -d
 
composer:
	$(PHP_EXEC) composer install
 
database:
	$(PHP_EXEC) bin/console doctrine:schema:update

stop:
	docker-compose down --volumes

test:
	APP_ENV=test docker-compose -f docker-compose.test.yml run php vendor/bin/behat -vvv