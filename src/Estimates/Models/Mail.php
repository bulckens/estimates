<?php

namespace Estimates\Models;

use Bulckens\ApiTools\Model;
use Bulckens\AppTools\App;

class Mail extends Model {

  protected $path = 'api/v1/estimates/mails';

  public function __construct( $details ) {
    // set api credentials
    $this->source( 'mailer' )->secret( 'mailer' );

    // set mail data
    $this->data([
      'mail' => array_replace([
        'to' => App::get()->config( 'mail.to' )
      , 'from' => App::get()->config( 'mail.from' )
      , 'subject' => "Offerteaanvraag van {$details['email']}"
      , 'language' => 'nl'
      ], $details )
    ]);
  }

}
