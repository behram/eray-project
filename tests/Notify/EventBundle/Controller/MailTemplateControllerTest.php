<?php

namespace Tests\EventBundle\Controller;

use Tests\Notify\EventBundle\EventBaseTestCase;

class MailTemplateControllerTest extends EventBaseTestCase
{
    public function testIndex()
    {
        $this->getProjectPath('mailtemplate/');
    }

    public function testNew()
    {
        $this->getProjectPath('mailtemplate/new');
    }

    public function testRemove()
    {
        $this->logIn();
        $project = $this->getUserProject();
        $mailTemplate = $this->sampleObjectLoader->loadMailTemplate($project);
        $this->client->request('GET', sprintf('/project/%s/mailtemplate/remove/%s', $project->getId(), $mailTemplate->getId()));

        $this->assertStatusCode(302, $this->client);
    }

    public function testEdit()
    {
        $this->logIn();
        $project = $this->getUserProject();
        $mailTemplate = $this->sampleObjectLoader->loadMailTemplate($project);
        $this->client->request('GET', sprintf('/project/%s/mailtemplate/%s/edit', $project->getId(), $mailTemplate->getId()));

        $this->isSuccessful($this->client->getResponse());
    }

    public function testShow()
    {
        $this->logIn();
        $project = $this->getUserProject();
        $mailTemplate = $this->sampleObjectLoader->loadMailTemplate($project);
        $this->client->request('GET', sprintf('/project/%s/mailtemplate/%s/show', $project->getId(), $mailTemplate->getId()));

        $this->isSuccessful($this->client->getResponse());
    }
}
