<?php

namespace Tests\AppBundle\Controller;

use Tests\Notify\AppBundle\AppBaseTestCase;

class DashboardControllerTest extends AppBaseTestCase
{
    public function testIndex()
    {
        $this->getProjectPath('');
    }

    public function testTryDemo()
    {
        $this->getProjectPath('tryDemo');
    }
}
