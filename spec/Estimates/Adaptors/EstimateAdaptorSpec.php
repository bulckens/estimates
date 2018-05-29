<?php

namespace spec\Estimates\Adaptors;

use Estimates\Adaptors\EstimateAdaptor;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EstimateAdaptorSpec extends ObjectBehavior {

  // Action methods
  function it_has_an_index_action() {
    $this->action( 'index' )->shouldHaveType( 'Bulckens\ApiTools\Action' );
  }

  function it_has_a_create_action() {
    $this->action( 'create' )->shouldHaveType( 'Bulckens\ApiTools\Action' );
  }

}
