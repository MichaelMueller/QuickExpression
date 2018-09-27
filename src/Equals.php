<?php

namespace Qck\Expression;

/**
 *
 * @author muellerm
 */
class Equals extends Comparison
{

  function __construct( Interfaces\ValueExpression $Left,
                        Interfaces\ValueExpression $Right )
  {
    parent::__construct( $Left, $Right );
  }

  public function evaluateProxy( array $Data, &$FilteredArray = [],
                                 &$FailedExpressions = [] )
  {
    $eval = $this->Left->evaluate( $Data, $FilteredArray, $FailedExpressions ) == $this->Right->evaluate( $Data, $FilteredArray, $FailedExpressions );

    return $eval;
  }

  public function getOperator( \Qck\Sql\Interfaces\DbDialect $Dictionary )
  {
    return "=";
  }
}
