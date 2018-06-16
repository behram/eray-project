<?php

namespace Tests\Notify\CreditBundle\Controller;

use Tests\BaseTestSetup;

class DefaultControllerTest extends BaseTestSetup
{
    public function testIndex()
    {
        $this->getProjectPath('credit/');
    }
}
