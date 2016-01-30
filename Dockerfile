FROM cnam/raml-base-builder

MAINTAINER V <v.tyubek@gmail.com>
MAINTAINER Cnam <cnam812@gmail.com>

COPY ./rel/raml2html.phar /

RUN chmod +x /raml2html.phar

ENTRYPOINT ["/raml2html.phar"]
