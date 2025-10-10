.DEFAULT_GOAL := help

.RUN_PHP := php

.PHONY: all $(MAKECMDGOALS) #see https://stackoverflow.com/questions/44492805/makefile-declare-all-targets-phony

ifneq ("$(wildcard .docker)","")
    include Makefile_Docker
endif

test: phpunit ## Run the test suite
qa: validate-composer phpstan cs lint ## Run the quality assurance suite

enable-docker: ## Enable Docker commands
	@touch .docker

disable-docker: ## Disable Docker commands
	@rm -f .docker

dependencies:
	$(.RUN_PHP) composer install --no-interaction --no-scripts --ansi

phpunit:
	$(.RUN_PHP) bin/phpunit

validate-composer:
	$(.RUN_PHP) composer validate --strict

lint: lint-container lint-yaml

lint-container:
	$(.RUN_PHP) bin/console lint:container --ansi

lint-yaml:
	$(.RUN_PHP) bin/console lint:yaml config --parse-tags --ansi

phpstan:
	$(.RUN_PHP) vendor/bin/phpstan analyse --no-progress --ansi --memory-limit=512M

cs:
	$(.RUN_PHP) vendor/bin/php-cs-fixer fix --diff --dry-run --ansi

cs-fix:
	$(.RUN_PHP) vendor/bin/php-cs-fixer fix --diff --ansi

# Based on https://www.thapaliya.com/en/writings/well-documented-makefiles/
help: ## Display this help
	@awk 'BEGIN {FS = ":.*##"; printf "\nUsage:\n make \033[36m<target>\033[0m\n\nTargets:\n"} /^[a-zA-Z_-]+:.*?##/ { printf " \033[36m%-20s\033[0m %s\n", $$1, $$2 }' $(MAKEFILE_LIST)
