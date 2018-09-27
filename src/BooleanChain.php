<?php

namespace Qck\Expression;

/**
 *
 * @author muellerm
 */
abstract class BooleanChain extends BooleanExpression implements Interfaces\BooleanChain
{

  abstract function getOperatorString();

  abstract function getOperator( \Qck\Sql\Interfaces\DbDialect $Dictionary );

  function add( Interfaces\BooleanExpression $Expression )
  {
    $this->Expressions[] = $Expression;
    return $this;
  }

  public function toSql( \Qck\Sql\Interfaces\DbDialect $Dictionary,
                         array &$Params = array () )
  {
    $Text = "(";

    $ExpCount = count( $this->Expressions );
    for ( $i = 0; $i < $ExpCount; $i++ )
    {
      $Xpression = $this->Expressions[ $i ];
      $Text .= $Xpression->toSql( $Dictionary, $Params );
      if ( $i + 1 < $ExpCount )
        $Text .= " " . $this->getOperator( $Dictionary ) . " ";
    }

    $Text .= ")";
    return $Text;
  }

  public function __toString()
  {
    $Text = "(";

    $ExpCount = count( $this->Expressions );
    for ( $i = 0; $i < $ExpCount; $i++ )
    {
      $Xpression = $this->Expressions[ $i ];
      $Text .= $Xpression->__toString();
      if ( $i + 1 < $ExpCount )
        $Text .= " " . $this->getOperatorString() . " ";
    }

    $Text .= ")";
    return $Text;
  }

  protected $Expressions;

}
