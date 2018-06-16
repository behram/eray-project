<?php

namespace Notify\Common\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Notify Base Controller controller.
 */
class NotifyController extends Controller
{
    /**
     * @param $entity
     * @param string $message
     *
     * @return bool
     */
    public function throw404IfNotFound($entity, $message = 'Not Found')
    {
        if (!$entity) {
            throw $this->createNotFoundException($this->get('translator')->trans($message));
        }

        return true;
    }

    protected function getEm()
    {
        return $this->getDoctrine()->getManager();
    }

    protected function getRepo($className)
    {
        return $this->getEm()->getRepository($className);
    }
}
