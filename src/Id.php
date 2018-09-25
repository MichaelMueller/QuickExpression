<?php

namespace Qck\Expression;

/**
 *
 * @author muellerm
 */
class Id extends ValueExpression
{

  static function create( $Name = null, $UseForFilteredArray = true )
  {
    return new GreaterEquals( $LeftOperand, $RightOperand );
  }

  function __construct( $Name = null, $UseForFilteredArray = true )
  {
    $this->Name = $Name;
    $this->UseForFilteredArray = $UseForFilteredArray;
  }

  function setName( ValueExpression $Name )
  {
    $this->Name = $Name;
    return $this;
  }

  function setUseForFilteredArray( $UseForFilteredArray )
  {
    $this->UseForFilteredArray = $UseForFilteredArray;
    return $this;
  }

  function getName()
  {
    return $this->Name;
  }

  public function evaluate( array $Data, &$FilteredArray = [], &$FailedExpressions = [] )
  {
    if ( !isset( $Data[ $this->Name ] ) )
    {
      $FailedExpressions[] = $this;
      return null;
    }
    else if ( $this->UseForFilteredArray )
      $FilteredArray[ $this->Name ] = $Data[ $this->Name ];
    return $Data[ $this->Name ];
  }

  public function toSql( \Qck\Interfaces\Sql\DbDialect $Dictionary,
                         array &$Params = array () )
  {
    return $this->Name;
  }

  /**
   *
   * @var ValueExpression
   */
  protected $Name;
  protected $UseForFilteredArray;

}
