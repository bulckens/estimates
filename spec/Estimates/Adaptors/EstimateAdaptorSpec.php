<?php

namespace spec\Estimates\Adaptors;

use Estimates\Adaptors\EstimateAdaptor;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EstimateAdaptorSpec extends ObjectBehavior {

  // Action methods
  function it_has_a_build_action() {
    $this->action( 'build' )->shouldHaveType( 'Bulckens\ApiTools\Action' );
  }

  function it_has_a_create_action() {
    $this->action( 'create' )->shouldHaveType( 'Bulckens\ApiTools\Action' );
  }


  // Build action
  function it_renders_the_build_view_creating_a_new_estimate() {

  }


  // Create action
  function it_renders_the_sent_view_if_an_estimate_has_been_created_successfully() {

  }

  function it_renders_the_build_view_if_an_estimate_has_errors() {
    
  }


}
