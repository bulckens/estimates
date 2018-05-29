<?php

namespace spec\Estimates\Models;

use Estimates\Models\Estimate;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EstimateSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Estimate::class);
    }
}
