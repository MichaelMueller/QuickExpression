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

  static function and_( array $Expressions = [], $EvaluateAll = false )
  {
    return new \Qck\Expression\And_( $Expressions, $EvaluateAll );
  }

  static function strlen( ValueExpression $Param )
  {
    return new \Qck\Expression\Strlen( $Param );
  }

  static function id( $Name, $UseForFilteredArray = true )
  {
    return new \Qck\Expression\Id( $Name, $UseForFilteredArray );
  }

  static function val( $Value )
  {
    return new \Qck\Expression\Value( $Value );
  }

  static function regexp( ValueExpression $LeftOperand, ValueExpression $RightOperand )
  {
    return new \Qck\Expression\Regexp($LeftOperand, $RightOperand );
  }
  
  static function gt( ValueExpression $LeftOperand, ValueExpression $RightOperand )
  {
    return new \Qck\Expression\Greater( $LeftOperand, $RightOperand );
  }

  static function ge( ValueExpression $LeftOperand, ValueExpression $RightOperand )
  {
    return new \Qck\Expression\GreaterEquals( $LeftOperand, $RightOperand );
  }

  static function eq( ValueExpression $LeftOperand, ValueExpression $RightOperand )
  {
    return new \Qck\Expression\Equals( $LeftOperand, $RightOperand );
  }

  static function ne( BooleanExpression $BooleanExpression )
  {
    return new \Qck\Expression\Not( $BooleanExpression );
  }

  static function lt( ValueExpression $LeftOperand, ValueExpression $RightOperand )
  {
    return new \Qck\Expression\Less( $LeftOperand, $RightOperand );
  }

  static function le( ValueExpression $LeftOperand, ValueExpression $RightOperand )
  {
    return new \Qck\Expression\LessEquals( $LeftOperand, $RightOperand );
  }
}
