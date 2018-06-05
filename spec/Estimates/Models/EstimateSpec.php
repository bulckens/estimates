<?php

namespace spec\Estimates\Models;

use Estimates\Models\Estimate;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EstimateSpec extends ObjectBehavior {

    function let() {
      $this->beConstructedWith([
        'details' => [
          'email' => 'pddi@zwartopwit.be'
        , 'telephone' => '0432654987'
        ]
      ]);
    }

    // IsValid method
    function it_can_be_valid() {
      $this->isValid()->shouldBe( true );
    }

    function it_can_be_invalid() {
      $this->beConstructedWith([]);
      $this->isValid()->shouldBe( false );
    }


    // Compose method
    function it_composes_an_email_from_given_form_data() {
      $composed = $this->compose();
      $composed->shouldContain( '------------------------------' );
      $composed->shouldContain( 'Details' );
      $composed->shouldContain( 'email: pddi@zwartopwit.be' );
      $composed->shouldContain( 'telephone: 0432654987' );
    }


    // Send methods
    function it_sends_an_email_using_the_mailer_api() {

    }


    // Store method
    function it_stores_the_uploaded_files_on_the_file_system() {

    }


    // Errors methods
    function it_returns_the_errors_array() {
      $this->errors()->shouldBeArray();
    }

    function it_returns_an_array_with_errors() {
      $this->beConstructedWith([]);
      $this->isValid();
      $this->errors()->shouldHaveCount( 2 );
    }


}
