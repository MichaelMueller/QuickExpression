<?php

namespace Qck\Expression\Tests;

use Qck\Expression\Expression;
use Qck\Expression\GreaterEquals;
use Qck\Expression\Strlen;
use Qck\Expression\Id;
use Qck\Expression\Value;
use Qck\Expression\Equals;
use Qck\Expression\And_;

/**
 *
 * @author muellerm
 */
class ExpressionTest extends \Qck\TestApp\Test
{

  public function run()
  {
    $TrueRegistrationData = [];
    $TrueRegistrationData[ "Name" ] = "Michi";
    $TrueRegistrationData[ "Pw" ] = "12345";
    $TrueRegistrationData[ "PwConfirm" ] = "12345";
    $TrueRegistrationData[ "Age" ] = 18;
    $TrueRegistrationData[ "Submit" ] = "OK";

    // validation expression: strlen(Name) > 4 && strlen(Pw) > 3 && Pw == PwConfirm && Age >= 18
    $NameValidator = GreaterEquals::create()->setLeft( new Strlen( new Id( "Name" ) ) )->setRight( new Value( 4 ) );
    $PwValidator = GreaterEquals::create()->setLeft( new Strlen( new Id( "Pw" ) ) )->setRight( new Value( 3 ) );
    $PwEqualsValidator = Equals::create()->setLeft( new Id( "Pw" ) )->setRight( new Id( "PwConfirm", false ) );
    $AgeValidator = GreaterEquals::create()->setLeft( new Id( "Age" ) )->setRight( new Value( 18 ) );
    $CompleteValidator = And_::create()->add( $NameValidator )->add( $PwEqualsValidator )->add( $PwValidator )->add( $AgeValidator );
    $this->assert( $CompleteValidator->evaluate( $TrueRegistrationData ) );
    $Filtered = $CompleteValidator->filterVar( $TrueRegistrationData );
    $this->assert( count( $Filtered ) == 3 && isset( $Filtered[ "Submit" ] ) == false );
    $Params = [];
    $this->assert( $CompleteValidator->toSql( new DbDialect(), $Params ) == "(strlen ( Name )  >= ? and Pw = PwConfirm and strlen ( Pw )  >= ? and Age >= ?)" );
    $this->assert( $Params == [ 4, 3, 18 ] );
  }

  public function getRequiredTests()
  {
    return array ();
  }

  protected $Dir;

}