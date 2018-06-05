<?php

namespace spec\Estimates\Models;

use Estimates\Models\Mail;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MailSpec extends ObjectBehavior {

  function it_define_the_mailer_resource() {
    $this->path()->shouldBe( '/api/v1/mails' );
  }
  
}
