<?php

namespace Tests\EventBundle\Controller;

use Tests\Notify\EventBundle\EventBaseTestCase;

class ScheduleControllerTest extends EventBaseTestCase
{
    public function testIndex()
    {
        $this->getProjectPath('schedule/');
    }

    public function testNew()
    {
        $this->getProjectPath('schedule/new');
    }

    public function testRemove()
    {
        $this->logIn();
        $project = $this->getUserProject();
        $schedule = $this->sampleObjectLoader->loadSchedule($project);
        $this->client->request('GET', sprintf('/project/%s/schedule/remove/%s', $project->getId(), $schedule->getId()));

        $this->assertStatusCode(302, $this->client);
    }

    public function testShow()
    {
        $this->logIn();
        $project = $this->getUserProject();
        $schedule = $this->sampleObjectLoader->loadSchedule($project);
        $this->client->request('GET', sprintf('/project/%s/schedule/%s/show', $project->getId(), $schedule->getId()));

        $this->isSuccessful($this->client->getResponse());
    }
}
