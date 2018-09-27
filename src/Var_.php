<?php

namespace Qck\Expression;

/**
 *
 * @author muellerm
 */
class Var_ extends ValueExpression implements Interfaces\Var_
{

  function __construct( $Name, array $Data, $FilterOut = false )
  {
    $this->Name = $Name;
    $this->Data = $Data;
    $this->FilterOut = $FilterOut;
  }

  function filterOut()
  {
    return $this->FilterOut;
  }

  function getName()
  {
    return $this->Name;
  }

  public function toSql( \Qck\Sql\Interfaces\DbDialect $Dictionary,
                         array &$Params = array () )
  {
    return $this->Name;
  }

  public function getValue()
  {
    return isset( $this->Data[ $this->Name ] ) ? $this->Data[ $this->Name ] : null;
  }

  /**
   *
   * @var string
   */
  protected $Name;

  /**
   *
   * @var array
   */
  protected $Data;

  /**
   *
   * @var bool
   */
  protected $FilterOut;

}
