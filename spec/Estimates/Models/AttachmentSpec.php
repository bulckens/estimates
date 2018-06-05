<?php

namespace spec\Estimates\Models;

use Estimates\Models\Attachment;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AttachmentSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Attachment::class);
    }
}
