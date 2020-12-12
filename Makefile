COMPOSER_BIN := $$(whereis -B /usr/local/bin /user/bin -f composer | awk '{ print $$2 }')

all: dev env # Install and build dependencies and bring up the dev environment

dev development: # Install and build application developemnt dependencies
	@$(COMPOSER_BIN) install --no-interaction
	@npm install && npm run dev

prod production: # Install and build application production dependencies
	@$(COMPOSER_BIN) install --no-dev --no-interaction --prefer-dist --optimize-autoloader
	@npm install --no-save && npm run production && npm prune --production

env environment: # Bring up the development environment
	@vendor/bin/sail up -d && vendor/bin/sail artisan migrate:fresh --seed

update upgrade: # Update application dependencies and publish dependency assets
	@$(COMPOSER_BIN) update && php artisan nova:publish && php artisan telescope:publish
	@npm update && npm install && npm audit fix

analyze: # Run coding standards/static analysis checks
	@vendor/bin/php-cs-fixer fix --diff --dry-run && vendor/bin/phpstan analyze

test: analyze # Run coding standards/static analysis checks and tests
	@vendor/bin/phpunit

coverage: # Generate HTML coverage report
	@vendor/bin/phpunit --coverage-html .coverage
