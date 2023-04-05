.DEFAULT_GOAL := help

.DOCKER_COMPOSE := docker compose
.DOCKER_RUN_PHP := $(.DOCKER_COMPOSE) run --rm php

.PHONY: all $(MAKECMDGOALS) #see https://stackoverflow.com/questions/44492805/makefile-declare-all-targets-phony

setup: build dependencies up ## Setup the project
restart: down up ## Restart the project
destroy: down-with-volumes ## Destroy the project
test: phpunit ## Run the test suite
qa: phpstan cs lint ## Run the quality assurance suite

build:
	$(.DOCKER_COMPOSE) build --pull

up:
	$(.DOCKER_COMPOSE) up -d

down:
	$(.DOCKER_COMPOSE) down

down-with-volumes:
	$(.DOCKER_COMPOSE) down --volumes --remove-orphans

dependencies:
	$(.DOCKER_RUN_PHP) composer install --no-interaction --no-scripts --ansi

phpunit:
	$(.DOCKER_RUN_PHP) bin/phpunit

shell:
	$(.DOCKER_RUN_PHP) sh

validate-composer:
	$(.DOCKER_RUN_PHP) composer validate --strict

lint: lint-container lint-yaml

lint-container:
	$(.DOCKER_RUN_PHP) bin/console lint:container

lint-yaml:
	$(.DOCKER_RUN_PHP) bin/console lint:yaml config --parse-tags

phpstan:
	$(.DOCKER_RUN_PHP) vendor/bin/phpstan analyse --no-progress

cs:
	$(.DOCKER_RUN_PHP) vendor/bin/php-cs-fixer fix --diff --dry-run --ansi

cs-fix:
	$(.DOCKER_RUN_PHP) vendor/bin/php-cs-fixer fix --diff --ansi

# Based on https://www.thapaliya.com/en/writings/well-documented-makefiles/
help: ## Display this help
	@awk 'BEGIN {FS = ":.*##"; printf "\nUsage:\n make \033[36m<target>\033[0m\n\nTargets:\n"} /^[a-zA-Z_-]+:.*?##/ { printf " \033[36m%-20s\033[0m %s\n", $$1, $$2 }' $(MAKEFILE_LIST)
