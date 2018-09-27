<?php

namespace Qck\Expression;

use Qck\Expression\Interfaces\ValueExpression;

/**
 *
 * @author muellerm
 */
abstract class Comparison extends BooleanExpression implements Interfaces\Comparison
{

  abstract function getOperator( \Qck\Sql\Interfaces\DbDialect $Dictionary );

  function __construct( ValueExpression $Left = null, ValueExpression $Right = null )
  {
    $this->Left = $Left;
    $this->Right = $Right;
  }

  function getLeft()
  {
    return $this->Left;
  }

  function getRight()
  {
    return $this->Right;
  }

  public function toSql( \Qck\Sql\Interfaces\DbDialect $SqlDbDialect,
                         array &$Params = array () )
  {
    return $this->Left->toSql( $SqlDbDialect, $Params ) . " " . $this->getOperator( $SqlDbDialect ) . " " . $this->Right->toSql( $SqlDbDialect, $Params );
  }

  /**
   *
   * @var ValueExpression
   */
  protected $Left;

  /**
   *
   * @var ValueExpression 
   */
  protected $Right;

}
