<?php

namespace Estimates\Adaptors;

use Estimates\Base\Adaptor;

class EstimateAdaptor extends Adaptor {

  // Estimate form
  public function build() {
    return $this->render( 'estimates/build.html.twig' );
  }


  // Create estimate
  public function create() {
    // build estimate from form data
    $estimate = new Estimate();

    if ( $estimate->isValid() ) {
      return $this->render( 'estimates/sent.html.twig' );
    } else {
      return $this->render( 'estimates/build.html.twig', [
        'estimate' => $estimate
      ]);
    }
  }

}
