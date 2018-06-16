<?php

namespace Tests\EventBundle\Controller;

use Tests\Notify\EventBundle\EventBaseTestCase;

class FilterControllerTest extends EventBaseTestCase
{
    public function testIndex()
    {
        $this->getProjectPath('filter/');
    }

    public function testNew()
    {
        $this->getProjectPath('filter/new');
    }

    public function testRemove()
    {
        $this->logIn();
        $project = $this->getUserProject();
        $filter = $this->sampleObjectLoader->loadFilter($project);
        $this->client->request('GET', sprintf('/project/%s/filter/remove/%s', $project->getId(), $filter->getId()));

        $this->assertStatusCode(302, $this->client);
    }

    public function testEdit()
    {
        $this->logIn();
        $project = $this->getUserProject();
        $filter = $this->sampleObjectLoader->loadFilter($project);
        $this->client->request('GET', sprintf('/project/%s/filter/%s/edit', $project->getId(), $filter->getId()));

        $this->isSuccessful($this->client->getResponse());
    }

    public function testShow()
    {
        $this->logIn();
        $project = $this->getUserProject();
        $filter = $this->sampleObjectLoader->loadFilter($project);
        $this->client->request('GET', sprintf('/project/%s/filter/%s/show', $project->getId(), $filter->getId()));

        $this->isSuccessful($this->client->getResponse());
    }
}
