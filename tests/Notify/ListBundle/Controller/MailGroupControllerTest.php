<?php

namespace Tests\AppBundle\Controller;

use Tests\Notify\ListBundle\ListBaseTestCase;

class MailGroupControllerTest extends ListBaseTestCase
{
    public function testIndex()
    {
        $this->getProjectPath('group/mail/');
    }

    public function testNew()
    {
        $this->getProjectPath('group/mail/new');
    }

    public function testRemove()
    {
        $this->logIn();
        $project = $this->getUserProject();
        $entity = $this->sampleObjectLoader->loadMailGroup($project);
        $this->client->request('GET', sprintf('/project/%s/group/mail/remove/%s', $project->getId(), $entity->getId()));

        $this->assertStatusCode(302, $this->client);
    }

    public function testEdit()
    {
        $this->logIn();
        $project = $this->getUserProject();
        $entity = $this->sampleObjectLoader->loadMailGroup($project);
        $this->client->request('GET', sprintf('/project/%s/group/mail/%s/edit', $project->getId(), $entity->getId()));

        $this->isSuccessful($this->client->getResponse());
    }

    public function testShow()
    {
        $this->logIn();
        $project = $this->getUserProject();
        $entity = $this->sampleObjectLoader->loadMailGroup($project);
        $this->client->request('GET', sprintf('/project/%s/group/mail/%s/show', $project->getId(), $entity->getId()));

        $this->isSuccessful($this->client->getResponse());
    }
}
