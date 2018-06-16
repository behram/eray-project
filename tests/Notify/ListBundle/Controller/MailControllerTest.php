<?php

namespace Tests\AppBundle\Controller;

use Tests\Notify\ListBundle\ListBaseTestCase;

class MailControllerTest extends ListBaseTestCase
{
    public function testIndex()
    {
        $this->getProjectPath('list/mail/');
    }

    public function testImport()
    {
        $this->getProjectPath('list/mail/bulk/import');
    }

    public function testNew()
    {
        $this->getProjectPath('list/mail/new');
    }

    public function testRemove()
    {
        $this->logIn();
        $project = $this->getUserProject();
        $entity = $this->sampleObjectLoader->loadMail($project);
        $this->client->request('GET', sprintf('/project/%s/list/mail/remove/%s', $project->getId(), $entity->getId()));

        $this->assertStatusCode(302, $this->client);
    }

    public function testEdit()
    {
        $this->logIn();
        $project = $this->getUserProject();
        $entity = $this->sampleObjectLoader->loadMail($project);
        $this->client->request('GET', sprintf('/project/%s/list/mail/%s/edit', $project->getId(), $entity->getId()));

        $this->isSuccessful($this->client->getResponse());
    }

    public function testShow()
    {
        $this->logIn();
        $project = $this->getUserProject();
        $entity = $this->sampleObjectLoader->loadMail($project);
        $this->client->request('GET', sprintf('/project/%s/list/mail/%s/show', $project->getId(), $entity->getId()));

        $this->isSuccessful($this->client->getResponse());
    }

    public function testMassRemove()
    {
        $this->logIn();
        $project = $this->getUserProject();
        $entity1 = $this->sampleObjectLoader->loadMail($project);
        $entity2 = $this->sampleObjectLoader->loadMail($project);
        $ids = implode(',', [$entity1->getId(), $entity2->getId()]);
        $this->client->request('GET', sprintf('/project/%s/list/mail/massremove/%s', $project->getId(), $ids));

        $this->assertStatusCode(302, $this->client);
    }
}
