<?php

namespace Qck\Expression;

/**
 *
 * @author muellerm
 */
class And_ extends BooleanChain
{

  static function create( array $Expressions = [], $EvaluateAll = false )
  {
    return new And_( $Expressions, $EvaluateAll );
  }

  function __construct( array $Expressions = [], $EvaluateAll = false )
  {
    parent::__construct( $Expressions );
    $this->EvaluateAll = $EvaluateAll;
  }

  public function evaluateProxy( array $Data, &$FilteredArray = [],
                                 &$FailedExpressions = [] )
  {
    $eval = true;
    foreach ( $this->Expressions as $Expression )
    {
      $eval = $eval && $Expression->evaluate( $Data, $FilteredArray, $FailedExpressions );
      if ( !$eval && $this->EvaluateAll == false )
        break;
    }
    return $eval;
  }

  public function getOperator( \Qck\Interfaces\Sql\DbDialect $Dictionary )
  {
    return "and";
  }

  protected $EvaluateAll;

}
