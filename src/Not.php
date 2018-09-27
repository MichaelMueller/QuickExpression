<?php

namespace Qck\Expression;

/**
 *
 * @author muellerm
 */
class Not extends BooleanExpression
{

  function __construct( BooleanExpression $BooleanExpression )
  {
    $this->BooleanExpression = $BooleanExpression;
  }

  public function evaluateProxy( array $Data, &$FilteredArray = [],
                                 &$FailedExpressions = [] )
  {
    return !$this->BooleanExpression->evaluate( $Data, $FilteredArray, $FailedExpressions );
  }

  public function toSql( \Qck\Sql\Interfaces\DbDialect $Dictionary,
                         array &$Params = array () )
  {
    return "not " . $this->BooleanExpression->toSql( $Dictionary, $Params );
  }

  /**
   *
   * @var BooleanExpression 
   */
  protected $BooleanExpression;

}
