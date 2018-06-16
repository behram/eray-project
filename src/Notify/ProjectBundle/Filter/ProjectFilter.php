<?php

namespace Notify\ProjectBundle\Filter;

use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Query\Filter\SQLFilter;
use Notify\Common\Services\ProjectService;
use Notify\ProjectBundle\Entity\Project;

class ProjectFilter extends SQLFilter
{
    /**
     * @var ProjectService
     */
    protected $projectService;

    /**
     * @return ProjectService
     */
    public function getProjectService()
    {
        return $this->projectService;
    }

    /**
     * @param ProjectService $projectService
     */
    public function setProjectService(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    public function addFilterConstraint(ClassMetadata $targetEntity, $targetTableAlias)
    {
        $mappings = $targetEntity->getAssociationMappings();
        if (!array_key_exists('project', $mappings) || $mappings['project']['targetEntity'] !== Project::class) {
            return '';
        }
        //return if project filter disabled globally for current entity
        if (isset($GLOBALS[$targetEntity->getName().'#projectFilter']) && $GLOBALS[$targetEntity->getName().'#projectFilter'] == false) {
            return '';
        }
        try {
            $selectedProject = $this->projectService->getSelectedProject();
        } catch (\Exception $e) {
            return '';
        }
        if (!$selectedProject) {
            return '';
        }
        $projectJoinColumn = $mappings['project']['joinColumns'][0]['name'];

        $addCondSql = $targetTableAlias.'.'.$projectJoinColumn.' = '.$selectedProject->getId();

        return $addCondSql;
    }
}
