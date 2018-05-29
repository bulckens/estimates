<?php

use Estimates\Adaptors\EstimateAdaptor;

$route->group( '/', function() use( $route ) {

  // intialize new adaptor
  $adaptor = new EstimateAdaptor();

  // get home
  $route->get(  '', [ $adaptor, 'index'  ]);
  $route->post( '', [ $adaptor, 'create' ]);

});
