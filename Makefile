.PHONY: lint

lint:
	composer run-script lint:cs-fixer
	composer run-script lint:stan