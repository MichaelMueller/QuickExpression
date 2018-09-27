<?php

namespace Qck\Expression;

/**
 *
 * @author muellerm
 */
class Regexp extends Comparison
{

  function __construct( Interfaces\ValueExpression $Left,
                        Interfaces\ValueExpression $Right )
  {
    parent::__construct( $Left, $Right );
  }

  public function getOperator( \Qck\Sql\Interfaces\DbDialect $Dictionary )
  {
    return $Dictionary->getRegExpOperator();
  }

  public function evaluateProxy( array $Data, &$FilteredArray = array (),
                                 &$FailedExpressions = array () )
  {
    return preg_match( $this->Left->evaluate( $Data, $FilteredArray, $FailedExpressions ), $this->Right->evaluate( $Data, $FilteredArray, $FailedExpressions ) ) == true;
  }
}
