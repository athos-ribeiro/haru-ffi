.PHONY: check clean

check:
	composer update --quiet
	vendor/bin/phpunit tests/
	vendor/bin/php-cs-fixer fix --dry-run --diff --using-cache=no -- .

clean:
	rm -rf vendor/ composer.lock .php-cs-fixer.cache
