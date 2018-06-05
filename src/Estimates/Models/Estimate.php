<?php

namespace Estimates\Models;

use Illuminate\Support\Str;
use Bulckens\AppTools\App;

class Estimate {

  protected $data;
  protected $errors;

  public function __construct( array $data ) {
    $this->data = $data;
  }


  // Validate estimate data
  public function isValid() {
    $this->errors = [];

    if ( ! isset( $this->data['details']['email'] )) {
      $this->errors[] = 'E-mail adres is vereist';
    }

    if ( ! isset( $this->data['details']['telephone'] )) {
      $this->errors[] = 'Telefoon is vereist';
    }

    return empty( $this->errors );
  }


  // Compose data into a readable text string
  public function compose() {
    $composed = [];

    foreach ( $this->data as $section => $pairs ) {
      $composed[] = "------------------------------";
      $composed[] = Str::studly( $section );
      $composed[] = "------------------------------";

      foreach ( $pairs as $key => $value ) {
        $composed[] = "$key: $value";
      }

      $composed[] = "\n";
    }

    return implode( "\n", $composed );
  }


  // Returns error
  public function errors() {
    return $this->errors ?: [];
  }

}
