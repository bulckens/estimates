<?php

namespace spec\Estimates\Adaptors;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\Environment;
use Bulckens\AppTools\App;
use Bulckens\ApiTools\Api;
use Bulckens\ApiTools\Token;
use Estimates\Adaptors\EstimateAdaptor;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EstimateAdaptorSpec extends ObjectBehavior {

  protected $req;
  protected $res;
  protected $args = [];

  function let() {
    $app = new App( 'test' );
    $app->module( 'api', new Api());
    $app->run();

    $token = new Token( 'estimates', 'authenticity_token' );

    $environment = Environment::mock([
      'REQUEST_URI' => '/'
    , 'QUERY_STRING' => "authenticity_token=$token"
    ]);
    $this->req = Request::createFromEnvironment( $environment );
    $this->res = new Response( 200 );
  }


  // Action methods
  function it_has_a_build_action() {
    $this->action( 'build' )->shouldHaveType( 'Bulckens\ApiTools\Action' );
  }

  function it_has_a_create_action() {
    $this->action( 'create' )->shouldHaveType( 'Bulckens\ApiTools\Action' );
  }


  // Build action
  function it_renders_the_build_view_creating_a_new_estimate() {
    $action = $this->action( 'build' );
    $result = $action( $this->req, $this->res, [])->getBody()->__toString();
    $result->shouldContain(
      '<form action="/" method="post" class="pure-form" id="offerteaanvraag">'
    );
  }


  // Create action
  function it_renders_the_sent_view_if_an_estimate_has_been_created_successfully() {
    $token = new Token( 'estimates', 'authenticity_token' );

    $environment = Environment::mock([
      'REQUEST_URI' => '/'
    , 'QUERY_STRING' => "authenticity_token=$token&estimate[details][email]=a@b.c&estimate[details][telephone]=123"
    ]);
    $this->req = Request::createFromEnvironment( $environment );

    $action = $this->action( 'create' );
    $result = $action( $this->req, $this->res, [])->getBody()->__toString();
    $result->shouldNotContain(
      '<form action="/" method="post" class="pure-form" id="offerteaanvraag">'
    );
  }

  function it_renders_the_build_view_if_an_estimate_has_errors() {
    $action = $this->action( 'create' );
    $result = $action( $this->req, $this->res, [])->getBody()->__toString();
    $result->shouldContain(
      '<form action="/" method="post" class="pure-form" id="offerteaanvraag">'
    );
  }


}
