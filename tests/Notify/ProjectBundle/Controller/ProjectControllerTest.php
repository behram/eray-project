<?php

namespace Tests\ProjectBundle\Controller;

use Tests\Notify\ProjectBundle\ProjectBaseTestCase;

class ProjectControllerTest extends ProjectBaseTestCase
{
    public function testDecide()
    {
        $this->logIn();
        $this->client->request('GET', '/projects/decide');
        $this->assertStatusCode(302, $this->client);
    }

    public function testNew()
    {
        $this->logIn();
        $this->client->request('GET', '/projects/new');
        $this->isSuccessful($this->client->getResponse());
    }
}
