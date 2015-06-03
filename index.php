<?php

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;

$command = new \Cnam\Command\GenerateCommand();
$watch = new \Cnam\Command\WatchCommand();

$application = new Application('raml2html', '0.0.4');

$application->add($command);
$application->add($watch);
$application->setDefaultCommand($command->getName());
$application->run();
