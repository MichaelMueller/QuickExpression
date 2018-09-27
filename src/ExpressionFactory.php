<?php

namespace Qck\Expression;

/**
 *
 * @author muellerm
 */
class ExpressionFactory implements Interfaces\ExpressionFactory
{

  function __construct( \Qck\Interfaces\ServiceRepo $ServiceRepo )
  {
    $this->ServiceRepo = $ServiceRepo;
  }

  function and_( $EvaluateAll = false )
  {
    return new \Qck\Expression\And_( $EvaluateAll );
  }

  function strlen( ValueExpression $Param )
  {
    return new \Qck\Expression\Strlen( $Param );
  }

  public function var_( $Name, array $Data, $FilterOut = false )
  {
    return new Var_( $Name, $Data, $FilterOut );
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

  public function requestVar_( $Name, $FilterOut = false )
  {
    /* @var $Request \Qck\App\Interfaces\Request */
    $Request = $this->ServiceRepo->get( \Qck\App\Interfaces\Request::class );
    return $this->var_( $Name, $Request->getParams(), $FilterOut );
  }

  /**
   *
   * @var \Qck\Interfaces\ServiceRepo
   */
  protected $ServiceRepo;

}
