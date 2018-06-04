<?php

use Estimates\Adaptors\EstimateAdaptor;

$route->group( '/', function() use( $route ) {

  // intialize new adaptor
  $adaptor = new EstimateAdaptor();

  // get home
  $route->get(  '', $adaptor->action( 'build' ));
  $route->post( '', $adaptor->action( 'create' ));

});
