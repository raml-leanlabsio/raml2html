<?php

require __DIR__.'/vendor/autoload.php';

$generator = new Cnam\Generator();

$generator->parse(__DIR__.'/example/twitter/api.raml');
$generator->generate(__DIR__.'/example/twitter.html');


$generator->parse(__DIR__.'/example/github/api.raml');
$generator->generate(__DIR__.'/example/github.html');

$generator->parse(__DIR__.'/example/api.raml');
$generator->generate(__DIR__.'/example/index.html');
