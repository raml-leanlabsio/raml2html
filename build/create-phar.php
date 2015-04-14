<?php

$root = __DIR__."/../";

$phar = new Phar($root . "raml2html.phar",
    FilesystemIterator::CURRENT_AS_FILEINFO |       FilesystemIterator::KEY_AS_FILENAME, "raml2html.phar");

$phar->buildFromDirectory($root,'/.php|.twig|.js|.css$/');

$phar->setStub($phar->createDefaultStub("index.php"));
