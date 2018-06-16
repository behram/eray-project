<?php

namespace Tests\HomeBundle\Controller;

use Tests\Notify\HomeBundle\HomeBaseTestCase;

class HomeControllerTest extends HomeBaseTestCase
{
    public function testIndex()
    {
        $this->client->request('GET', '/');
        $this->isSuccessful($this->client->getResponse());
    }

    public function testContact()
    {
        $this->client->request('GET', '/contact');
        $this->isSuccessful($this->client->getResponse());
    }

    public function testTextTracker()
    {
        $this->client->request('GET', '/testTracker');
        $this->isSuccessful($this->client->getResponse());
    }
}
