<?php

namespace Qck\Expression\Tests;

use \Qck\AppFramework\DefaultRouter;
use \Qck\AppFramework\Request;

class AppConfig extends \Qck\AppFramework\AppConfig
{

  function __construct()
  {
    ini_set( 'log_errors', 0 );
    ini_set( 'display_errors', 1 );
  }

  public function getAppName()
  {
    return \Qck\Expression\Tests\ExpressionTest::class;
  }

  public function getRouter()
  {
    return $this->getSingleton( "Router", function()
        {
          return new DefaultRouter( $this->getRequest(), [ \Qck\AppFramework\DefaultRouter::DEFAULT_QUERY => \Qck\TestApp\Controller\Start::class ] );
        } );
  }

  function getRequest()
  {
    return $this->getSingleton( "Request", function()
        {
          return new Request( [ "suite" => Suite::class ] );
        } );
  }
}
