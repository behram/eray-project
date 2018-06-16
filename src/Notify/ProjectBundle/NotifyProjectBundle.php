<?php

namespace Notify\ProjectBundle;

use Doctrine\ORM\EntityManagerInterface;
use Notify\ProjectBundle\Filter\ProjectFilter;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class NotifyProjectBundle extends Bundle
{
    public function boot()
    {
        /** @var EntityManagerInterface $em */
        $em = $this->container->get('doctrine.orm.default_entity_manager');

        $conf = $em->getConfiguration();

        $conf->addFilter(
            'projectFilter',
            ProjectFilter::class
        );

        $projectService = $this->container->get('notify.project_service');
        /** @var ProjectFilter $projectFilter */
        $projectFilter = $em->getFilters()->enable('projectFilter');

        $projectFilter->setProjectService($projectService);
    }
}
