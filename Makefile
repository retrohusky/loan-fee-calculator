.PHONY: lint test composer run

lint:
	composer run-script lint:cs-fixer
	composer run-script lint:stan
test:
	composer run-script test

composer:
	docker compose run --rm composer

run:
	docker compose run --rm php