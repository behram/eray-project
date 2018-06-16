<?php

namespace Tests\AppBundle\Controller;

use Tests\Notify\ListBundle\ListBaseTestCase;

class SmsGroupControllerTest extends ListBaseTestCase
{
    public function testIndex()
    {
        $this->getProjectPath('group/sms/');
    }

    public function testNew()
    {
        $this->getProjectPath('group/sms/new');
    }

    public function testRemove()
    {
        $this->logIn();
        $project = $this->getUserProject();
        $entity = $this->sampleObjectLoader->loadSmsGroup($project);
        $this->client->request('GET', sprintf('/project/%s/group/sms/remove/%s', $project->getId(), $entity->getId()));

        $this->assertStatusCode(302, $this->client);
    }

    public function testEdit()
    {
        $this->logIn();
        $project = $this->getUserProject();
        $entity = $this->sampleObjectLoader->loadSmsGroup($project);
        $this->client->request('GET', sprintf('/project/%s/group/sms/%s/edit', $project->getId(), $entity->getId()));

        $this->isSuccessful($this->client->getResponse());
    }

    public function testShow()
    {
        $this->logIn();
        $project = $this->getUserProject();
        $entity = $this->sampleObjectLoader->loadSmsGroup($project);
        $this->client->request('GET', sprintf('/project/%s/group/sms/%s/show', $project->getId(), $entity->getId()));

        $this->isSuccessful($this->client->getResponse());
    }
}
