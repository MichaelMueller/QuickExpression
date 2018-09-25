<?php

// this should point to the main PSR-4 Autoloader
require_once( __DIR__ . '/../../vendor/autoload.php');

// create & run application
$App = new \Qck\AppFramework\App( new \Qck\AppFramework\AppConfigFactory( \Qck\Expression\Tests\AppConfig::class ) );
$App->run();
