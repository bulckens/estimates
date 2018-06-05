<?php

namespace spec\Estimates\Base;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\Environment;
use Bulckens\AppTools\App;
use Bulckens\ApiTools\Api;
use Bulckens\ApiTools\Token;
use Estimates\Base\Adaptor;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AdaptorSpec extends ObjectBehavior {

  protected $req;
  protected $res;
  protected $args = [];

  function let() {
    $app = new App( 'test' );
    $app->module( 'api', new Api());
    $app->run();

    $environment = Environment::mock([ 'REQUEST_URI' => '/' ]);
    $this->req = Request::createFromEnvironment( $environment );
    $this->res = new Response( 200 );
  }

  // Render method
  function it_add_an_authenticity_token() {
    $action = $this->action( 'render' );
    $action( $this->req, $this->res, []);
    $result = $this->render( 'data-token="{{ authenticity_token }}"' )->getBody()->__toString();
    $result->shouldMatch( '/^data-token="[a-z0-9]{75}"$/' );
  }

  function it_maintains_the_other_local_variables_along_with_the_authenticity_token() {
    $action = $this->action( 'render' );
    $action( $this->req, $this->res, []);
    $result = $this->render( 'keyurma={{ valurma }}', [
      'valurma' => 'benurma'
    ])->getBody()->__toString();
    $result->shouldBe( 'keyurma=benurma' );
  }


  // GenerateToken methods
  function it_generates_an_authenticity_token() {
    $this->generateToken()->shouldMatch( '/^[a-z0-9]{75}$/' );
  }


  // ValidateToken method
  function it_validates_an_authenticity_token() {
    $authenticity_token = $this->generateToken();
    $this->verifyToken( $authenticity_token )->shouldBe( true );
  }

  function it_does_not_validate_an_invalid_authenticity_token() {
    $this->verifyToken( 'somerandomjibberjabber' )->shouldBe( false );
  }


  // BuildToken method
  function it_builds_an_authenticity_token() {
    $this->buildToken()->shouldHaveType( 'Bulckens\ApiTools\Token' );
  }


  // RequireToken
  function it_is_silent_if_a_valid_authenticity_token_is_given() {
    $token = new Token( 'estimates', 'authenticity_token' );

    $environment = Environment::mock([
      'REQUEST_URI' => '/'
    , 'QUERY_STRING' => "authenticity_token=$token"
    ]);
    $this->req = Request::createFromEnvironment( $environment );
    $this->res = new Response( 200 );

    $action = $this->action( 'render' );
    $action( $this->req, $this->res, []);

    $this->requireToken()->shouldBeNull();
  }

  function it_fails_if_no_authenticity_token_is_given() {
    $action = $this->action( 'render' );
    $action( $this->req, $this->res, []);

    $this
      ->shouldThrow( 'Estimates\Base\AdaptorMissingAuthenticityTokenException' )
      ->duringRequireToken();
  }

  function it_fails_if_an_invalid_authenticity_token_is_given() {
    $environment = Environment::mock([
      'REQUEST_URI' => '/'
    , 'QUERY_STRING' => 'authenticity_token=attack'
    ]);
    $this->req = Request::createFromEnvironment( $environment );
    $this->res = new Response( 200 );

    $action = $this->action( 'render' );
    $action( $this->req, $this->res, []);

    $this
      ->shouldThrow( 'Estimates\Base\AdaptorInvalidAuthenticityTokenException' )
      ->duringRequireToken();
  }

}
