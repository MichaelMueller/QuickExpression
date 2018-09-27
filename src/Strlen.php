<?php

namespace Qck\Expression;

/**
 *
 * @author muellerm
 */
class Strlen extends SingleParamFunction
{

  static function create( ValueExpression $Param = null )
  {
    return new Strlen( $Param = null );
  }

  function __construct( ValueExpression $Param = null )
  {
    parent::__construct( $Param );
  }

  public function evaluate( array $Data, &$FilteredArray = [], &$FailedExpressions = [] )
  {
    return mb_strlen( $this->Param->evaluate( $Data, $FilteredArray, $FailedExpressions ) );
  }

  public function toSql( \Qck\Sql\Interfaces\DbDialect $Dictionary,
                         array &$Params = array () )
  {
    return $Dictionary->getStrlenFunctionName() . " ( " . $this->Param->toSql( $Dictionary, $Params ) . " ) ";
  }
}
