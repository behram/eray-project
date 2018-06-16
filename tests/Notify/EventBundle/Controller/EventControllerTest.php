<?php

namespace Tests\AppBundle\Controller;

use Tests\Notify\EventBundle\EventBaseTestCase;

class EventControllerTest extends EventBaseTestCase
{
    public function testGetPaths()
    {
        $this->getProjectPath('events/');
    }

    public function testNewMessageBox()
    {
        $this->getProjectPath('events/new/messageBox');
    }

    public function testNewNotificationBox()
    {
        $this->getProjectPath('events/new/notificationBox');
    }

    public function testNewAlertBox()
    {
        $this->getProjectPath('events/new/alertBox');
    }

    public function testNewRedirect()
    {
        $this->getProjectPath('events/new/redirect');
    }

    public function testNewLink()
    {
        $this->getProjectPath('events/new/link');
    }

    public function testNewIframe()
    {
        $this->getProjectPath('events/new/iframe');
    }

    public function testNewScript()
    {
        $this->getProjectPath('events/new/script');
    }

    public function testNewSms()
    {
        $this->getProjectPath('events/new/sms');
    }

    public function testNewMail()
    {
        $this->getProjectPath('events/new/mail');
    }

    public function testNewGcm()
    {
        $this->getProjectPath('events/new/gcm');
    }

    public function testRemove()
    {
        $project = $this->getUserProject();
        $event = $this->sampleObjectLoader->loadEvent($project);
        $this->client->request('GET', sprintf('/project/%s/events/remove/%s', $project->getId(), $event->getId()));

        $this->assertStatusCode(302, $this->client);
    }

    public function testShow()
    {
        $project = $this->getUserProject();
        $event = $this->sampleObjectLoader->loadEvent($project);
        $this->getProjectPath(sprintf('events/%s/show/', $event->getId()));
    }
}
