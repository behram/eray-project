<?php

namespace Notify\AppBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Notify\AppBundle\Service\ProjectRelationsFixer;
use Notify\ProjectBundle\Entity\Project;

class ProjectOrmListener
{
    /**
     * @var ProjectRelationsFixer
     */
    private $fixer;

    public function __construct(ProjectRelationsFixer $fixer)
    {
        $this->fixer = $fixer;
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if (!$entity instanceof Project) {
            return;
        }
        $this->fixer->setEm($args->getEntityManager());
        $this->fixer->normalizeProjectRelations($entity);
    }
}
