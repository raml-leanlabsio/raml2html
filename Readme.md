# RAML to HTML converter with beautiful template.

[![](https://badge.imagelayers.io/cnam/raml-doc-builder:latest.svg)](https://imagelayers.io/?images=cnam/raml-doc-builder:latest 'Get your own badge on imagelayers.io')

### Installation

> git clone git@github.com:raml-leanlabsio/raml2html.git && cd raml2html && composer update --no-dev

## Usage

### As binary

```shell
./raml2html generate -i example/raml/basic/api.raml -o index.html
```

### As docker image

Assuming that command executed in project directory containing raml file

```shell
docker run  \
   -v `pwd`:/data \
   leanlabs/raml-doc-builder \
   generate --input=input.raml --output=doc.html
```

### OPTIONS

- **-i, --input** input file base raml file with includes. (required)
- **-o, --output** output file "index.html" (required)


---

 - raml2html base in [raml parser](https://github.com/alecsammon/php-raml-parser)

 - official [raml specification](http://raml.org/)
 
