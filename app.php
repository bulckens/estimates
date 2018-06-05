<?php

// Ensure required constants
if ( ! defined( 'APP_ROOT' ) )
  define( 'APP_ROOT', __DIR__ );
if ( ! defined( 'APP_ENV' ) )
  define( 'APP_ENV', getenv( 'APP_ENV' ) ? getenv( 'APP_ENV' ) : 'development' );

require 'vendor/autoload.php';

use Bulckens\AppTools\App;
use Bulckens\ApiTools\Api;

// initialize application
$app = new App( APP_ENV );
$app->module( 'api', new Api());
$app->run();
