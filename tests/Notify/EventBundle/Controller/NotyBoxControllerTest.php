<?php

namespace Tests\EventBundle\Controller;

use Tests\Notify\EventBundle\EventBaseTestCase;

class NotyBoxControllerTest extends EventBaseTestCase
{
    public function testIndex()
    {
        $this->getProjectPath('notybox/');
    }

    public function testNew()
    {
        $this->getProjectPath('notybox/new');
    }

    public function testRemove()
    {
        $this->logIn();
        $project = $this->getUserProject();
        $notyBox = $this->sampleObjectLoader->loadNotyBox($project);
        $this->client->request('GET', sprintf('/project/%s/notybox/remove/%s', $project->getId(), $notyBox->getId()));

        $this->assertStatusCode(302, $this->client);
    }

    public function testEdit()
    {
        $this->logIn();
        $project = $this->getUserProject();
        $notyBox = $this->sampleObjectLoader->loadNotyBox($project);
        $this->client->request('GET', sprintf('/project/%s/notybox/%s/edit', $project->getId(), $notyBox->getId()));

        $this->isSuccessful($this->client->getResponse());
    }

    public function testShow()
    {
        $this->logIn();
        $project = $this->getUserProject();
        $notyBox = $this->sampleObjectLoader->loadNotyBox($project);
        $this->client->request('GET', sprintf('/project/%s/notybox/%s/show', $project->getId(), $notyBox->getId()));

        $this->isSuccessful($this->client->getResponse());
    }
}
