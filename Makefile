build:
	@docker build --force-rm --pull --build-arg COMPOSER_AUTH='${COMPOSER_AUTH}' --tag phlak/chriskankiewicz.com:local .

build-test:
	@docker build --force-rm --pull --build-arg COMPOSER_AUTH='${COMPOSER_AUTH}' --tag phlak/chriskankiewicz.com:local .
	@docker image rm --force phlak/chriskankiewicz.com:local
