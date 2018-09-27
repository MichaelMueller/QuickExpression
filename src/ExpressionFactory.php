<?php

namespace Qck\Expression;

use Qck\Expression\Interfaces\ValueExpression;
use Qck\Expression\Interfaces\BooleanExpression;

/**
 *
 * @author muellerm
 */
class ExpressionFactory implements Interfaces\ExpressionFactory
{

  function and_( $EvaluateAll = false )
  {
    return new \Qck\Expression\And_( $EvaluateAll );
  }

  function strlen( ValueExpression $Param )
  {
    return new \Qck\Expression\Strlen( $Param );
  }

  public function var_( $Name, $FilterOut = false )
  {
    return new Var_( $Name, $FilterOut );
  }

  function val( $Value )
  {
    return new \Qck\Expression\Value( $Value );
  }

  function gt( ValueExpression $LeftOperand, ValueExpression $RightOperand )
  {
    return new \Qck\Expression\Greater( $LeftOperand, $RightOperand );
  }

  function ge( ValueExpression $LeftOperand, ValueExpression $RightOperand )
  {
    return new \Qck\Expression\GreaterEquals( $LeftOperand, $RightOperand );
  }

  function eq( ValueExpression $LeftOperand, ValueExpression $RightOperand )
  {
    return new \Qck\Expression\Equals( $LeftOperand, $RightOperand );
  }

  function ne( BooleanExpression $BooleanExpression )
  {
    return new \Qck\Expression\Not( $BooleanExpression );
  }

  function lt( ValueExpression $LeftOperand, ValueExpression $RightOperand )
  {
    return new \Qck\Expression\Less( $LeftOperand, $RightOperand );
  }

  function le( ValueExpression $LeftOperand, ValueExpression $RightOperand )
  {
    return new \Qck\Expression\LessEquals( $LeftOperand, $RightOperand );
  }

  public function or_()
  {
    return new \Qck\Expression\Or_();
  }

  public function boolVal( $BoolValue )
  {
    return new BooleanValueExpression( $BoolValue );
  }

  public function choice( Interfaces\ValueExpression $Value, array $Choices )
  {
    $Or = $this->or_();
    foreach ( $Choices as $Choice )
      $Or->add( $this->eq( $Value, $this->val( $Choice ) ) );
    return $Or;
  }
}
