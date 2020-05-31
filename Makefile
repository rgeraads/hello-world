.DEFAULT_GOAL := help

.DOCKER_COMPOSE := docker-compose
.DOCKER_RUN_PHP := $(.DOCKER_COMPOSE) run --rm php

.PHONY: all $(MAKECMDGOALS) #see https://stackoverflow.com/questions/44492805/makefile-declare-all-targets-phony

setup: build dependencies up ## Setup the project
destroy: down-with-volumes ## Destroy the project
test: phpunit ## Run the test suite

build:
	$(.DOCKER_COMPOSE) build --pull

up:
	$(.DOCKER_COMPOSE) up -d

down:
	$(.DOCKER_COMPOSE) down

down-with-volumes:
	$(.DOCKER_COMPOSE) down --volumes --remove-orphans

dependencies:
	$(.DOCKER_RUN_PHP) composer install --no-interaction --no-suggest --no-scripts --ansi

phpunit:
	$(.DOCKER_RUN_PHP) bin/phpunit

# Based on https://www.thapaliya.com/en/writings/well-documented-makefiles/
help: ## Display this help
	@awk 'BEGIN {FS = ":.*##"; printf "\nUsage:\n make \033[36m<target>\033[0m\n\nTargets:\n"} /^[a-zA-Z_-]+:.*?##/ { printf " \033[36m%-20s\033[0m %s\n", $$1, $$2 }' $(MAKEFILE_LIST)
