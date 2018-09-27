<?php

/* @var $ServiceRepo Qck\ServiceRepo */
$ServiceRepo = Qck\ServiceRepo::getInstance();

// ADD SERVICES *************
$ServiceRepo->addServiceFactory( \Qck\Expression\ExpressionFactory::class, function() use($ServiceRepo)
{
  return new \Qck\Expression\ExpressionFactory( $ServiceRepo );
} );

$ServiceRepo->addServiceFactory( \Qck\Expression\TestSuite::class, function()
{
  return new \Qck\Expression\TestSuite();
} );
