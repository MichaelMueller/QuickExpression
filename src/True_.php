<?php

namespace Qck\Expression;

/**
 *
 * @author muellerm
 */
class True_ extends BooleanExpression
{

  public function evaluateProxy( array $Data, &$FilteredArray = [] )
  {
    return true;
  }

  public function toSql( \Qck\Sql\Interfaces\DbDialect $Dictionary,
                         array &$Params = array () )
  {
    return $Dictionary->getTrueLiteral();
  }
  
  function __toString()
  {
    return "true";
  }
}
