<?php

namespace Notify\UserBundle\Controller;

use Notify\Common\Controller\NotifyController as Controller;
use Notify\UserBundle\Entity\User;

/**
 * Class ApiKeyController
 * @package Notify\UserBundle\Controller
 */
class ApiKeyController extends Controller
{
    public function regenerateApiKeyAction()
    {
        $getCurrentUser = $this->getUser();
        $em = $this->getEm();
        /** @var User $findUser */
        $findUser = $em->getRepository(User::class)->find($getCurrentUser->getId());
        $findUser->generateApiKey();
        $em->flush();

        return $this->redirectToRoute('user_get_api_key');
    }

    public function getApiKeyAction()
    {
        return $this->render('NotifyUserBundle:ApiKey:get_api_key.html.twig');
    }
}
