<?php

use Symfony\Component\Console\Application;
use System\Commands\CreateModelCommand;

require __DIR__ . '/vendor/autoload.php';


$application = new Application();

$application->add(new CreateModelCommand());

$application->run();