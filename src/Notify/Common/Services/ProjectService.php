<?php

namespace Notify\Common\Services;

use Notify\ProjectBundle\Entity\Project;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Common methods for journal.
 */
class ProjectService
{
    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * ProjectService constructor.
     *
     * @param RequestStack $requestStack
     */
    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    /**
     * @return Project|null
     */
    public function getSelectedProject()
    {
        $request = $this->requestStack->getCurrentRequest();
        if (!isset($request)) {
            return null;
        }

        return $request->get('_project');
    }
}
