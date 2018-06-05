<?php

namespace Estimates\Base;

use Bulckens\ApiTools\Adaptor as BaseAdaptor;
use Bulckens\ApiTools\Token;

class Adaptor extends BaseAdaptor {

  // Extend render method
  public function render( $subject = null, $locals = [] ) {
    // generate new authenticity_token and add it to the locals array
    $locals = array_replace( $locals, [
      'authenticity_token' => $this->generateToken()
    ]);

    return parent::render( $subject, $locals );
  }


  // Generate an authenticity token
  public function generateToken() {
    return $this->buildToken()->get();
  }


  // Verify validity of authenticity token
  public function verifyToken( $authenticity_token ) {
    return $this->buildToken()->validate( $authenticity_token );
  }


  // Build authenticity token
  public function buildToken() {
    return new Token( 'estimates', 'authenticity_token' );
  }


  // Require authenticity token or fail
  public function requireToken() {
    // find token
    $token = $this->req()->getParam( 'authenticity_token' );

    // verify token existence
    if ( ! is_string( $token )) {
      throw new AdaptorMissingAuthenticityTokenException( 'Missing authenticity token' );
    }

    // verify token validity
    if ( ! $this->verifyToken( $token )) {
      throw new AdaptorInvalidAuthenticityTokenException( 'Invalid authenticity token' );
    }
  }

}


// Exceptions
class AdaptorMissingAuthenticityTokenException extends \Exception {}
class AdaptorInvalidAuthenticityTokenException extends \Exception {}
