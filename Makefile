all: dev env # Install and build dependencies and bring up the dev environment

dev development: # Install and build application developemnt dependencies
	@composer install --no-interaction
	@npm install && npm run dev

prod production: # Install and build application production dependencies
	@composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader
	@npm install --no-save && npm run production && npm prune --production

env environment: # Bring up the development environment
	@docker-compose up -d
	@echo "Waiting for the database..." && sleep 10
	@php artisan migrate:fresh --seed

update upgrade: # Update application dependencies and publish dependency assets
	@composer update && php artisan nova:publish && php artisan telescope:publish
	@npm update && npm install && npm audit fix

test: # Run coding standards/static analysis checks and tests
	@vendor/bin/php-cs-fixer fix --diff --dry-run \
		&& vendor/bin/phpstan analyze \
		&& vendor/bin/phpunit --coverage-text

coverage: # Generate HTML coverage report
	@vendor/bin/phpunit --coverage-html .coverage

tunnel: # Expose the application via secure tunnel
	@ngrok http -host-header=rewrite http://chriskankiewicz.local:80
