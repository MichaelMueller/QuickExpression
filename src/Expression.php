<?php

namespace Qck\Expression;

use Qck\Expression\ValueExpression;

/**
 *
 * @author muellerm
 */
abstract class Expression implements \Qck\Interfaces\Expression
{

  function filterVar( array $Data, &$FailedExpressions = [] )
  {
    $FilteredArray = [];
    $IsValid = $this->evaluate( $Data, $FilteredArray, $FailedExpressions );
    return $IsValid ? $FilteredArray : false;
  }

}
