.PHONY: check clean

check:
	composer update
	vendor/bin/phpunit tests/
	vendor/bin/php-cs-fixer fix --dry-run --diff -- .

clean:
	rm -rf vendor/ composer.lock .php-cs-fixer.cache
