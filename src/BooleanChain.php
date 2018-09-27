<?php

namespace Qck\Expression;

/**
 *
 * @author muellerm
 */
abstract class BooleanChain extends BooleanExpression implements Interfaces\BooleanChain
{

  abstract function getOperator( \Qck\Sql\Interfaces\DbDialect $Dictionary );

  function add( BooleanExpression $Expression )
  {
    $this->Expressions[] = $Expression;
    return $this;
  }

  public function toSql( \Qck\Sql\Interfaces\DbDialect $Dictionary,
                         array &$Params = array () )
  {
    $Sql = "(";

    $ExpCount = count( $this->Expressions );
    for ( $i = 0; $i < $ExpCount; $i++ )
    {
      $Xpression = $this->Expressions[ $i ];
      $Sql .= $Xpression->toSql( $Dictionary, $Params );
      if ( $i + 1 < $ExpCount )
        $Sql .= " " . $this->getOperator( $Dictionary ) . " ";
    }

    $Sql .= ")";
    return $Sql;
  }

  protected $Expressions;

}
