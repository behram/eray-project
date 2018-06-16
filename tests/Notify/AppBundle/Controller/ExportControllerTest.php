<?php

namespace Tests\AppBundle\Controller;

use Tests\Notify\AppBundle\AppBaseTestCase;

class ExportControllerTest extends AppBaseTestCase
{
    public function testCdnScript()
    {
        $this->client->request('GET', '/cdnUt.js');
        $this->isSuccessful($this->client->getResponse());
    }

    public function testCdnLib()
    {
        $this->client->request('GET', '/export/cdnLib');
        $this->isSuccessful($this->client->getResponse());
    }
}
