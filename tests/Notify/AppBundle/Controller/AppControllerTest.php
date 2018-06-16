<?php

namespace Tests\AppBundle\Controller;

use Tests\Notify\AppBundle\AppBaseTestCase;

class AppControllerTest extends AppBaseTestCase
{
    public function testIndex()
    {
        $this->getProjectPath('apps/');
    }

    public function testNew()
    {
        $this->getProjectPath('apps/new');
    }

    public function testRemove()
    {
        $this->logIn();
        $project = $this->getUserProject();
        $app = $this->sampleObjectLoader->loadApp($project);
        $this->client->request('GET', sprintf('/project/%s/apps/remove/%s', $project->getId(), $app->getId()));

        $this->assertStatusCode(302, $this->client);
    }

    public function testEdit()
    {
        $this->logIn();
        $project = $this->getUserProject();
        $app = $this->sampleObjectLoader->loadApp($project);
        $this->client->request('GET', sprintf('/project/%s/apps/%s/edit', $project->getId(), $app->getId()));

        $this->isSuccessful($this->client->getResponse());
    }

    public function testShow()
    {
        $this->logIn();
        $project = $this->getUserProject();
        $app = $this->sampleObjectLoader->loadApp($project);
        $this->client->request('GET', sprintf('/project/%s/apps/%s/show', $project->getId(), $app->getId()));

        $this->isSuccessful($this->client->getResponse());
    }

    public function testGetSdk()
    {
        $this->logIn();
        $project = $this->getUserProject();
        $app = $this->sampleObjectLoader->loadApp($project);
        $this->client->request('GET', sprintf('/project/%s/apps/%s/getSdk', $project->getId(), $app->getId()));

        $this->isSuccessful($this->client->getResponse());
    }
}
