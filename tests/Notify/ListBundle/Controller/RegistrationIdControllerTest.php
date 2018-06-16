<?php

namespace Tests\AppBundle\Controller;

use Tests\Notify\ListBundle\ListBaseTestCase;

class RegistrationIdControllerTest extends ListBaseTestCase
{
    public function testIndex()
    {
        $this->getProjectPath('list/registrationId/');
    }

    public function testNew()
    {
        $this->getProjectPath('list/registrationId/new');
    }

    public function testRemove()
    {
        $this->logIn();
        $project = $this->getUserProject();
        $entity = $this->sampleObjectLoader->loadRegistrationId($project);
        $this->client->request('GET', sprintf('/project/%s/list/registrationId/remove/%s', $project->getId(), $entity->getId()));

        $this->assertStatusCode(302, $this->client);
    }

    public function testEdit()
    {
        $this->logIn();
        $project = $this->getUserProject();
        $entity = $this->sampleObjectLoader->loadRegistrationId($project);
        $this->client->request('GET', sprintf('/project/%s/list/registrationId/%s/edit', $project->getId(), $entity->getId()));

        $this->isSuccessful($this->client->getResponse());
    }

    public function testShow()
    {
        $this->logIn();
        $project = $this->getUserProject();
        $entity = $this->sampleObjectLoader->loadRegistrationId($project);
        $this->client->request('GET', sprintf('/project/%s/list/registrationId/%s/show', $project->getId(), $entity->getId()));

        $this->isSuccessful($this->client->getResponse());
    }
}
