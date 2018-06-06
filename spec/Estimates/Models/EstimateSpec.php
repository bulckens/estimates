<?php

namespace spec\Estimates\Models;

use Bulckens\AppTools\App;
use Bulckens\ApiTools\Api;
use Estimates\Models\Estimate;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EstimateSpec extends ObjectBehavior {

    function let() {
      $app = new App( 'test' );
      $app->module( 'api', new Api());
      $app->run();

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


    // Save method
    function it_can_be_saved() {
      $this->save()->shouldBe( true );
    }


    // Send method
    function it_sends_an_email_using_the_mailer_api() {
      $this->send()->shouldBe( true );
    }


    // Store method
    function it_stores_the_uploaded_files_on_the_file_system() {
      // TODO: grab uploaded files and store them in a specific location
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
