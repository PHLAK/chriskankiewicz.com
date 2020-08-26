dev development: # Build application for development
	@composer install --no-interaction
	@npm install && npm run dev

prod production: # Build application for production
	@composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader
	@npm install --no-save && npm run production && npm prune --production

update upgrade: # Update application dependencies
	@composer update && php artisan nova:publish && php artisan telescope:publish
	@npm update && npm install && npm audit fix

test: # Run coding standards/static analysis checks and tests
	@vendor/bin/php-cs-fixer fix --diff --dry-run \
		&& vendor/bin/psalm \
		&& vendor/bin/phpunit --coverage-text

coverage: # Generate HTML coverage report
	@vendor/bin/phpunit --coverage-html .coverage

tunnel: # Expose the application via secure tunnel
	@ngrok http -host-header=rewrite http://chriskankiewicz.local:80
