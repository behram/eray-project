<?php

namespace Tests\AppBundle\Controller;

use Tests\Notify\ListBundle\ListBaseTestCase;

class PhoneControllerTest extends ListBaseTestCase
{
    public function testIndex()
    {
        $this->getProjectPath('list/phone/');
    }

    public function testImport()
    {
        $this->getProjectPath('list/phone/bulk/import');
    }

    public function testNew()
    {
        $this->getProjectPath('list/phone/new');
    }

    public function testRemove()
    {
        $this->logIn();
        $project = $this->getUserProject();
        $entity = $this->sampleObjectLoader->loadPhoneNumber($project);
        $this->client->request('GET', sprintf('/project/%s/list/phone/remove/%s', $project->getId(), $entity->getId()));

        $this->assertStatusCode(302, $this->client);
    }

    public function testEdit()
    {
        $this->logIn();
        $project = $this->getUserProject();
        $entity = $this->sampleObjectLoader->loadPhoneNumber($project);
        $this->client->request('GET', sprintf('/project/%s/list/phone/%s/edit', $project->getId(), $entity->getId()));

        $this->isSuccessful($this->client->getResponse());
    }

    public function testShow()
    {
        $this->logIn();
        $project = $this->getUserProject();
        $entity = $this->sampleObjectLoader->loadPhoneNumber($project);
        $this->client->request('GET', sprintf('/project/%s/list/phone/%s/show', $project->getId(), $entity->getId()));

        $this->isSuccessful($this->client->getResponse());
    }

    public function testMassRemove()
    {
        $this->logIn();
        $project = $this->getUserProject();
        $entity1 = $this->sampleObjectLoader->loadPhoneNumber($project);
        $entity2 = $this->sampleObjectLoader->loadPhoneNumber($project);
        $ids = implode(',', [$entity1->getId(), $entity2->getId()]);
        $this->client->request('GET', sprintf('/project/%s/list/phone/massremove/%s', $project->getId(), $ids));

        $this->assertStatusCode(302, $this->client);
    }
}
