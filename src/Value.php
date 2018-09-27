<?php

namespace Qck\Expression;

/**
 *
 * @author muellerm
 */
class Value implements Interfaces\ValueExpression
{

  function __construct( $Value )
  {
    $this->Value = $Value;
  }

  function getValue( array $Data = [], array &$FilteredData = [] )
  {
    return $this->Value;
  }

  public function toSql( \Qck\Sql\Interfaces\DbDialect $Dictionary,
                         array &$Params = array () )
  {
    $Params[] = $this->Value;
    return "?";
  }

  /**
   *
   * @var mixed
   */
  protected $Value;

}
