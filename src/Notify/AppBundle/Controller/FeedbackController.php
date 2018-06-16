<?php

namespace Notify\AppBundle\Controller;

use Notify\AppBundle\Entity\Feedback;
use Notify\AppBundle\Form\FeedbackType;
use Notify\Common\Controller\NotifyController as Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class FeedbackController
 * @package Notify\AppBundle\Controller
 */
class FeedbackController extends Controller
{
    /**
     * @return Response
     */
    public function indexAction()
    {
        return $this->render('NotifyAppBundle:Feedback:feedbacks.html.twig', [
            'feedbacks' => $this->getRepo(Feedback::class)->findAll(),
        ]);
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse|Response
     */
    public function newAction(Request $request)
    {
        $em = $this->getEm();

        $entity = new Feedback();
        $form = $this->createForm(FeedbackType::class, $entity);
        $form->add('submit', SubmitType::class, ['label' => 'Create']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entity->setProject($request->get('_project'));
            $em->persist($entity);
            $em->flush();
            $this->addFlash('success', 'successful.create');

            return $this->redirectToRoute('feedbacks');
        }

        return $this->render('NotifyAppBundle:Feedback:new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @param Feedback $entity
     *
     * @return Response
     */
    public function editAction(Request $request, Feedback $entity)
    {
        $em = $this->getEm();
        $form = $this->createForm(FeedbackType::class, $entity);
        $form->add('submit', SubmitType::class, ['label' => 'Update']);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($entity);
            $em->flush();
            $this->addFlash('success', 'successful.update');

            return $this->redirectToRoute('feedback_edit', ['id' => $entity->getId()]);
        }

        return $this->render('NotifyAppBundle:Feedback:edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Feedback $entity
     *
     * @return RedirectResponse
     */
    public function removeAction(Feedback $entity)
    {
        $em = $this->getEm();
        $em->remove($entity);
        $em->flush();
        $this->addFlash('success', 'successful.remove');

        return $this->redirectToRoute('feedbacks');
    }

    /**
     * @param Feedback $entity
     *
     * @return Response
     */
    public function showAction(Feedback $entity)
    {
        return $this->render('NotifyAppBundle:Feedback:show.html.twig', [
            'entity' => $entity,
        ]);
    }

    /**
     * @param Feedback $feedback
     *
     * @return Response
     */
    public function getCodeAction(Feedback $feedback)
    {
        if ($feedback->getConsoleLog()) {
            $feedback->setConsoleLog('true');
        } else {
            $feedback->setConsoleLog('false');
        }

        return $this->render('NotifyAppBundle:Feedback:getCode.html.twig', [
            'feedback' => $feedback,
        ]);
    }
}
