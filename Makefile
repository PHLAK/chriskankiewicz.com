dev development: # Build application for development
	@composer install --no-interaction
	@npm install && npm run dev

prod production: # Build application for production
	@composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader
	@npm install --no-save && npm run production && npm prune --production

update upgrade: # Update application dependencies
	@composer update && npm update && npm install

test: # Run coding standards/static analysis checks and tests
	@php-cs-fixer fix --diff --dry-run && psalm --show-info=false && phpunit --coverage-text

coverage: # Generate HTML coverage report
	@phpunit --coverage-html .coverage

tunnel: # Expose the application via secure tunnel
	@ngrok http -host-header=rewrite http://chriskankiewicz.local:80
