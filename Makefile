RUN := docker-compose run --rm app

FG_BLUE := "$$(tput setaf 4)"
RESET_FORMAT := "$$(tput sgr0)"

all: dev env # Install and build dependencies and bring up the dev environment

dev development: # Install and build application developemnt dependencies
	@$(RUN) composer install --no-interaction
	@$(RUN) npm install && npm run dev

prod production: # Install and build application production dependencies
	@$(RUN) composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader
	@$(RUN) npm install --no-save && npm run production && npm prune --production

env environment: # Bring up the development environment
	@docker-compose up -d && $(RUN) php artisan migrate:fresh --seed

update upgrade: # Update application dependencies and publish dependency assets
	@$(RUN) composer update && php artisan nova:publish && php artisan telescope:publish
	@$(RUN) npm update && npm install && npm audit fix

outdated: # Check for outdated PHP and JavaScript dependencies
	@echo "$(FG_BLUE)>>>$(RESET_FORMAT) Checking for outdated PHP packages"
	@$(RUN) composer show --direct --outdated
	@echo "$(FG_BLUE)>>>$(RESET_FORMAT) Checking for outdated JavaScript packages"
	@$(RUN) npm outdated

php-cs-fixer: # Check PHP coding standards with PHP Coding Standards Fixer
	@$(RUN) vendor/bin/php-cs-fixer fix --diff --dry-run

eslint: # Check JavaScript coding standards with ESLint
	@$(RUN) npm run cs

coding-standards: php-cs-fixer eslint # Check coding standards

static-analysis: # Run static analysis checks
	@$(RUN) vendor/bin/phpstan analyze

analyze: coding-standards static-analysis # Run coding standards and static analysis checks

test: # Run tests
	@$(RUN) vendor/bin/phpunit

suite: analyze test # Run coding standards and static analysis checks and tests

tunnel: # Expose the application via secure tunnel
	@$(RUN) composer exec expose share chriskankiewicz.local

coverage: # Generate HTML coverage report
	@$(RUN) vendor/bin/phpunit --coverage-html .coverage
