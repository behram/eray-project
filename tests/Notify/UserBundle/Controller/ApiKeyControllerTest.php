<?php

namespace Tests\UserBundle\Controller;

use Tests\Notify\UserBundle\UserBaseTestCase;

class ApiKeyControllerTest extends UserBaseTestCase
{
    public function testRegenerateApiKey()
    {
        $project = $this->getUserProject();
        $this->client->request('GET', sprintf('/project/%s/profile/settings/regenerateApiKey', $project->getId()));
        $this->assertStatusCode(302, $this->client);
    }

    public function testApiKey()
    {
        $project = $this->getUserProject();
        $this->client->request('GET', sprintf('/project/%s/profile/get/apikey', $project->getId()));
        $this->isSuccessful($this->client->getResponse());
    }
}
