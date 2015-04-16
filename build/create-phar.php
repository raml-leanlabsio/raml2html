<?php

$root = __DIR__."/../";

$phar = new Phar($root . "raml2html.phar",
    FilesystemIterator::CURRENT_AS_FILEINFO |       FilesystemIterator::KEY_AS_FILENAME, "raml2html.phar");

$phar->buildFromDirectory($root,'/.php|.twig|.js|.css$/');

$defaultStub = $phar->createDefaultStub("index.php");

// Create a custom stub to add the shebang
$stub = "#!/usr/bin/php \n".$defaultStub;

// Add the stub
$phar->setStub($stub);

$phar->stopBuffering();

