build:
	@docker build --force-rm --pull --build-arg COMPOSER_AUTH='${COMPOSER_AUTH}' --build-arg FONT_AWESOME_TOKEN='${FONT_AWESOME_TOKEN}' --tag phlak/chriskankiewicz.com:local .

build-test:
	@docker build --force-rm --pull --build-arg COMPOSER_AUTH='${COMPOSER_AUTH}' --build-arg FONT_AWESOME_TOKEN='${FONT_AWESOME_TOKEN}' --tag phlak/chriskankiewicz.com:local .
	@docker image rm --force phlak/chriskankiewicz.com:local

coverage:
	@phpunit --coverage-html .coverage
