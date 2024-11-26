lint:
	composer run-script lint:cs-fixer
	composer run-script lint:stan
test:
	composer run-script test

build:
	docker compose build

composer:
	docker compose run --rm composer

run:
	docker compose run --rm php