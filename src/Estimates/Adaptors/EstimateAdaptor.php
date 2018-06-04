<?php

namespace Estimates\Adaptors;

use Bulckens\ApiTools\Adaptor;

class EstimateAdaptor extends Adaptor {

  // Estimate form
  public function build() {
    return $this->render( 'estimates/build.html.twig', [
      
    ]);
  }


  // Create estimate
  public function create() {
    echo 'goodbij';
  }

}
