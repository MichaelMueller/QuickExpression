<?php

namespace Qck\Expression;

/**
 *
 * @author muellerm
 */
abstract class SingleParamFunction extends ValueExpression
{

  function __construct( ValueExpression $Param )
  {
    $this->Param = $Param;
  }

  function setParam( ValueExpression $Param )
  {
    $this->Param = $Param;
    return $this;
  }

  function getParam()
  {
    return $this->Param;
  }

  /**
   *
   * @var ValueExpression
   */
  protected $Param;

}
