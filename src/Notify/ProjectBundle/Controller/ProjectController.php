<?php

namespace Notify\ProjectBundle\Controller;

use Notify\Common\Controller\NotifyController as Controller;
use Notify\EventBundle\Entity\Schedule;
use Notify\ProjectBundle\Entity\Project;
use Notify\ProjectBundle\Form\ProjectType;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProjectController extends Controller
{
    /**
     * @return RedirectResponse
     */
    public function decideProjectAction()
    {
        return $this->redirectToRoute('notify_dashboard');
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse|Response
     */
    public function newAction(Request $request)
    {
        $em = $this->getEm();
        $project = new Project();
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $project->setUser($this->getUser());
            $em->persist($project);
            $em->flush();

            return $this->redirectToRoute('notify_dashboard', [
                'projectId' => $project->getId(),
            ]);
        }

        return $this->render('NotifyProjectBundle:Project:new.html.twig', [
            'form' => $form->createView(),
            'hideMenu' => true,
        ]);
    }
}
