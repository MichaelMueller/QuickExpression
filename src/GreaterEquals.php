<?php

namespace Qck\Expression;

/**
 *
 * @author muellerm
 */
class GreaterEquals extends Comparison
{
  static function create(ValueExpression $LeftOperand=null, ValueExpression $RightOperand=null)
  {
    return new GreaterEquals($LeftOperand, $RightOperand);
  }
  function __construct( ValueExpression $LeftOperand=null, ValueExpression $RightOperand=null )
  {
    parent::__construct( $LeftOperand, $RightOperand );
  }

  public function evaluateProxy( array $Data, &$FilteredArray = [], &$FailedExpressions = [] )
  {
    return $this->LeftOperand->evaluate( $Data, $FilteredArray, $FailedExpressions ) >= $this->RightOperand->evaluate( $Data, $FilteredArray, $FailedExpressions );
  }

  public function getOperator( \Qck\Interfaces\Sql\DbDialect $Dictionary )
  {
    return ">=";
  }
}
