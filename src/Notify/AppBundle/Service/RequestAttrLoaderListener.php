<?php

namespace Notify\AppBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use Notify\ProjectBundle\Entity\Project;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Routing\RouterInterface;

class RequestAttrLoaderListener implements EventSubscriberInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var RouterInterface
     */
    private $router;

    public function __construct(EntityManagerInterface $em, RouterInterface $router)
    {
        $this->em = $em;
        $this->router = $router;
    }

    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::REQUEST => array(array('onKernelRequest')),
        );
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        if (!$request->hasSession()) {
            return;
        }
        $attributes = $event->getRequest()->attributes;

        //if have any route param return null
        if (!$attributes->has('_route_params') || empty($routeParams = $attributes->get('_route_params'))) {
            return;
        }
        if ($attributes->has('_project') || !array_key_exists('projectId', $routeParams)) {
            return;
        }
        $projectId = (int) $routeParams['projectId'];
        if ($projectId == 0) {
            return;
        }
        $project = $this->em->getRepository(Project::class)->find($projectId);
        if (!$project) {
            throw new NotFoundHttpException('project not found!');
        }
        $attributes->set('_project', $project);
        $this->router->getContext()->setParameter('projectId', $project->getId());
    }
}
