<?php

namespace spec\Estimates\Models;

use Estimates\Models\Estimate;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EstimateSpec extends ObjectBehavior {

    // IsValid method
    function it_can_be_valid() {
      $this->isValid()->shouldBe( true );
    }

    function it_can_be_invalid() {
      $this->isValid()->shouldBe( false );
    }


    // Compose method
    function it_composes_an_email_from_given_form_data() {

    }


    // Send methods
    function it_sends_an_email_using_the_mailer_api() {

    }


    // Store method
    function it_stores_the_uplaoded_files_on_the_file_system() {

    }


}
