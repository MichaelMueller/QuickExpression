<?php

namespace Qck\Expression\Tests;

/**
 * implementation of a system cmd
 *
 * @author micha
 */
class Suite implements \Qck\Interfaces\TestSuite
{

  public function getTests()
  {
    return [ ExpressionTest::class ];
  }
}
