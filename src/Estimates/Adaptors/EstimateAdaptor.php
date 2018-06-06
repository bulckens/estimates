<?php

namespace Estimates\Adaptors;

use Estimates\Base\Adaptor;
use Estimates\Models\Estimate;

class EstimateAdaptor extends Adaptor {

  // Estimate form
  public function build() {
    return $this->render( 'estimates/build.html.twig' );
  }


  // Create estimate
  public function create() {
    $this->requireToken();

    // build estimate from form data
    $estimate = new Estimate( $this->req()->getParam( 'estimate' ));

    if ( $estimate->isValid() ) {
      $estimate->save();

      return $this->render( 'estimates/show.html.twig' );
      
    } else {
      return $this->render( 'estimates/build.html.twig', [
        'estimate' => $estimate
      ]);
    }
  }

}
