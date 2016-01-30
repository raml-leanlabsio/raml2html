IMAGE = cnam/raml-doc-builder
TAG   = 0.0.6

vendor:
	@docker run --rm \
		-v `pwd`:/data \
		imega/composer update

test: vendor
	@docker run --rm \
		-v `pwd`:/data \
		-w /data \
		cnam/raml-base-builder \
		php index.php generate -i example/raml/basic/api.raml -o index.html

test_bin:
	@docker run --rm \
		-v `pwd`:/data \
		-w /data \
		cnam/raml-base-builder \
		php ./rel/raml2html.phar generate -i example/raml/basic/api.raml -o index.html

test_release:
	@docker run --rm \
		-v `pwd`:/data \
		-w /data \
		$(IMAGE):$(TAG) \
		generate -i example/raml/basic/api.raml -o index.html

rel/raml2html.phar: vendor
	-@mkdir rel

	@docker run --rm  \
		-v `pwd`:/data \
		-w /data \
		tes\tes  \
		php build/create-phar.php

release: clean rel/raml2html.phar test_bin build_release test_release

build_release:
	@docker build -t $(IMAGE) .
	@docker tag $(IMAGE):latest $(IMAGE):$(TAG)
	@docker push $(IMAGE):latest
	@docker push $(IMAGE):$(TAG)

serve:
	@docker run -d \
		-v `pwd`/build/sites-enabled:/etc/nginx/sites-enabled \
		-v `pwd`:/data \
		-p 8080:80 \
		leanlabs/nginx

clean:
	-@rm -rf rel/raml2html.phar

.PHONY: test release
