<?php

namespace Qck\Expression;

/**
 *
 * @author muellerm
 */
class Equals extends Comparison
{

  static function create(ValueExpression $LeftOperand=null, ValueExpression $RightOperand=null)
  {
    return new Equals($LeftOperand, $RightOperand);
  }
  
  function __construct( ValueExpression $LeftOperand=null, ValueExpression $RightOperand=null )
  {
    parent::__construct( $LeftOperand, $RightOperand );
  }

  public function evaluateProxy( array $Data, &$FilteredArray = [], &$FailedExpressions = [] )
  {
    $eval = $this->LeftOperand->evaluate( $Data, $FilteredArray, $FailedExpressions ) == $this->RightOperand->evaluate( $Data, $FilteredArray, $FailedExpressions );

    return $eval;
  }

  public function getOperator( \Qck\Interfaces\Sql\DbDialect $Dictionary )
  {
    return "=";
  }
}
