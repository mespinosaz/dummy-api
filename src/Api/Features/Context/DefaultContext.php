<?php

namespace Bcn\Api\Features\Context;

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;

class DefaultContext implements Context
{
    /**
     * @When /^I do a dummy action$/
     */
    public function iDoADummyAction()
    {
        throw new PendingException();
    }
}
