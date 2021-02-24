PHP_EXEC := docker-compose exec -T php
PHP_TARGET := alma-test-technique_php
NGINX_TARGET := alma-test-technique_nginx
 
build:
	docker build -t $(PHP_TARGET) -f infra/php/Dockerfile .
	docker build -t $(NGINX_TARGET) -f infra/nginx/Dockerfile .

init:
	cp .env.dist .env

start:
	docker-compose up -d
 
composer:
	$(PHP_EXEC) composer install
 
database:
	$(PHP_EXEC) bin/console doctrine:schema:update

stop:
	docker-compose down --volumes --remove-orphans
