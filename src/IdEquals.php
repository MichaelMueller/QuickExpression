<?php

namespace Qck\Expression;

/**
 *
 * @author muellerm
 */
class IdEquals extends Equals
{

  function __construct( $TargetId, $IdPropName = "Id" )
  {
    parent::__construct( new Id( $IdPropName ), new Value( $TargetId ) );
  }
}
