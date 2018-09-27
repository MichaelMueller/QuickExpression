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

  public function varEq( $varName, $Value )
  {
    return $this->eq( $this->var_( $varName ), $this->val( $Value ) );
  }

  public function varGreater( $varName, $Value )
  {
    return $this->gt( $this->var_( $varName ), $this->val( $Value ) );
  }

  public function varGt( $varName, $Value )
  {
    return $this->ge( $this->var_( $varName ), $this->val( $Value ) );
  }

  public function varLe( $varName, $Value )
  {
    return $this->le( $this->var_( $varName ), $this->val( $Value ) );
  }

  public function varLt( $varName, $Value )
  {
    return $this->lt( $this->var_( $varName ), $this->val( $Value ) );
  }

  public function varNe( $varName, $Value )
  {
    return $this->ne( $this->var_( $varName ), $this->val( $Value ) );
  }

  public function varEqVar( $varName, $var2Name )
  {
    return $this->eq( $this->var_( $varName ), $this->var_( $var2Name ) );
    
  }
}
