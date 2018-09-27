<?php

namespace Qck\Expression\Tests;

use Qck\Expression\GreaterEquals;
use Qck\Expression\Strlen;
use Qck\Expression\Var_;
use Qck\Expression\Value;
use Qck\Expression\Equals;
use Qck\Expression\And_;

/**
 *
 * @author muellerm
 */
class ExpressionTest implements \Qck\Interfaces\Test
{

  public function getRequiredTests()
  {
    return array ();
  }

  public function exec( \Qck\Interfaces\ServiceRepo $ServiceRepo )
  {
    /* @var $e \Qck\Expression\Interfaces\ExpressionFactory */
    $e = $ServiceRepo->get( \Qck\Expression\Interfaces\ExpressionFactory::class );

    $Data = [];
    $Data[ "Name" ] = "Michi";
    $Data[ "Pw" ] = "12345";
    $Data[ "PwConfirm" ] = "12345";
    $Data[ "Age" ] = 18;
    $Data[ "Submit" ] = "OK";

    $TargetSql = "(strlen ( Name )  >= ? and Pw = PwConfirm and strlen ( Pw )  >= ? and Age >= ?)";
    // validation expression: strlen(Name) > 4 && strlen(Pw) > 3 && Pw == PwConfirm && Age >= 18
    $NameVar = $e->var_( "Name" );
    $NameValidator = $e->ge( $e->strlen( $NameVar ), $e->val( 4 ) );

    $PwVar = $e->var_( "Pw" );
    $PwValidator = $e->ge( $e->strlen( $PwVar ), $e->val( 3 ) );

    $PwEqualsValidator = $e->eq( $PwVar, $e->var_( "PwConfirm", true ) );

    $AgeVar = $e->var_( "Age" );
    $AgeValidator = $e->ge( $AgeVar, $e->val( 18 ) );

    $CompleteValidator = $e->and_( true )->add( $NameValidator )->add( $PwEqualsValidator )->add( $PwValidator )->add( $AgeValidator );

    if ( !$CompleteValidator->evaluate( $Data ) )
      throw new \Exception( "CompleteValidator failed" );

    $Filtered = $CompleteValidator->filterVar( $Data );
    if ( count( $Filtered ) != 3 || isset( $Filtered[ "Submit" ] ) )
      throw new \Exception( "filterVar failed" );

    $Params = [];
    $Sql = $CompleteValidator->toSql( new DbDialect(), $Params );

    if ( $Sql != $TargetSql || $Params != [ 4, 3, 18 ] )
      throw new \Exception( "toSql failed" );
  }

  protected $Dir;

}
