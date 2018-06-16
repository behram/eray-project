<?php

namespace Tests\AppBundle\Controller;

use Tests\Notify\AppBundle\AppBaseTestCase;

class TrackerControllerTest extends AppBaseTestCase
{
    public function testIndex()
    {
        $this->getProjectPath('trackers/');
    }

    public function testNew()
    {
        $this->getProjectPath('trackers/new');
    }

    public function testRemove()
    {
        $this->logIn();
        $project = $this->getUserProject();
        $entity = $this->sampleObjectLoader->loadTracker($project);
        $this->client->request('GET', sprintf('/project/%s/trackers/remove/%s', $project->getId(), $entity->getId()));

        $this->assertStatusCode(302, $this->client);
    }

    public function testEdit()
    {
        $this->logIn();
        $project = $this->getUserProject();
        $entity = $this->sampleObjectLoader->loadTracker($project);
        $this->client->request('GET', sprintf('/project/%s/trackers/%s/edit', $project->getId(), $entity->getId()));

        $this->isSuccessful($this->client->getResponse());
    }

    public function testShow()
    {
        $this->logIn();
        $project = $this->getUserProject();
        $entity = $this->sampleObjectLoader->loadTracker($project);
        $this->client->request('GET', sprintf('/project/%s/trackers/%s/show', $project->getId(), $entity->getId()));

        $this->isSuccessful($this->client->getResponse());
    }

    public function testGetCode()
    {
        $this->logIn();
        $project = $this->getUserProject();
        $entity = $this->sampleObjectLoader->loadTracker($project);
        $this->client->request('GET', sprintf('/project/%s/trackers/getCode/%s', $project->getId(), $entity->getId()));

        $this->isSuccessful($this->client->getResponse());
    }
}
