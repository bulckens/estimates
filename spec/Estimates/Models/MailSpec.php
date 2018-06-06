<?php

namespace spec\Estimates\Models;

use Bulckens\AppTools\App;
use Bulckens\ApiTools\Api;
use Estimates\Models\Mail;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MailSpec extends ObjectBehavior {

  function let() {
    $app = new App( 'test' );
    $app->module( 'api', new Api());
    $app->run();

    $this->beConstructedWith([
      'from' => 'me@him.com'
    , 'text' => 'Something funny.'
    ]);
  }


  // Endpoint path
  function it_define_the_mailer_resource() {
    $this->path()->shouldBe( '/api/v1/estimates/mails' );
  }


  // Post methods
  function it_posts_to_the_mailer_api() {
    $result = $this->post()->parse();
    $result->shouldHaveKeyWithValue( 'success', 'mail.created' );
  }

}
