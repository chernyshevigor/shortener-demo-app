include .env 
$(shell touch .env.local)  
include .env.local 

export $(shell sed 's/=.*//' .env) 
export $(shell sed 's/=.*//' .env.local)

DOCKER_COMPOSE?=docker compose
DOCKER_COMPOSE_CONFIG := -f docker-compose.yml -f docker-compose.$(APP_ENV).yml

help:
	@awk 'BEGIN {FS = ":.*##"; printf "\nUsage:\n"} /^[$$()% a-zA-Z_-]+:.*?##/ { printf "  \033[32m%-30s\033[0m %s\n", $$1, $$2 } /^##@/ { printf "\n\033[1m%s\033[0m\n", substr($$0, 5) } ' $(MAKEFILE_LIST)

build: ##
	$(DOCKER_COMPOSE) $(DOCKER_COMPOSE_CONFIG) build --force-rm

pull: ##
	$(DOCKER_COMPOSE) $(DOCKER_COMPOSE_CONFIG) pull

up: ##
	$(DOCKER_COMPOSE) $(DOCKER_COMPOSE_CONFIG) up -d --remove-orphans

stop: ##
	$(DOCKER_COMPOSE) $(DOCKER_COMPOSE_CONFIG) stop

in-fpm: ##
	$(DOCKER_COMPOSE) $(DOCKER_COMPOSE_CONFIG) exec fpm bash

in-mysql: ##
	$(DOCKER_COMPOSE) $(DOCKER_COMPOSE_CONFIG) exec mysql bash

check: ##
	$(DOCKER_COMPOSE) $(DOCKER_COMPOSE_CONFIG) exec -T fpm composer check

phpcsfix: ##
	$(DOCKER_COMPOSE) $(DOCKER_COMPOSE_CONFIG) exec -T fpm composer phpcsfix

db-init: ##
	$(DOCKER_COMPOSE) $(DOCKER_COMPOSE_CONFIG) exec -T fpm console doctrine:schema:update --force --complete