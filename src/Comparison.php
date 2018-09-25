<?php

namespace Qck\Expression;

/**
 *
 * @author muellerm
 */
abstract class Comparison extends BooleanExpression
{

  abstract function getOperator( \Qck\Interfaces\Sql\DbDialect $Dictionary );

  function __construct( ValueExpression $LeftOperand = null,
                        ValueExpression $RightOperand = null )
  {
    $this->LeftOperand = $LeftOperand;
    $this->RightOperand = $RightOperand;
  }

  function setLeft( ValueExpression $LeftOperand )
  {
    $this->LeftOperand = $LeftOperand;
    return $this;
  }

  function setRight( ValueExpression $RightOperand )
  {
    $this->RightOperand = $RightOperand;
    return $this;
  }

  function getLeftOperand()
  {
    return $this->LeftOperand;
  }

  function getRightOperand()
  {
    return $this->RightOperand;
  }

  public function toSql( \Qck\Interfaces\Sql\DbDialect $SqlDbDialect,
                         array &$Params = array () )
  {
    return $this->LeftOperand->toSql( $SqlDbDialect, $Params ) . " " . $this->getOperator( $SqlDbDialect ) . " " . $this->RightOperand->toSql( $SqlDbDialect, $Params );
  }

  /**
   *
   * @var ValueExpression
   */
  protected $LeftOperand;

  /**
   *
   * @var ValueExpression 
   */
  protected $RightOperand;

}
