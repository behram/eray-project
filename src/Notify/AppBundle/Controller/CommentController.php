<?php

namespace Notify\AppBundle\Controller;

use Notify\AppBundle\Entity\Comment;
use Notify\AppBundle\Form\CommentType;
use Notify\Common\Controller\NotifyController as Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CommentController
 * @package Notify\AppBundle\Controller
 */
class CommentController extends Controller
{
    /**
     * @return Response
     */
    public function indexAction()
    {
        return $this->render('NotifyAppBundle:Comment:comments.html.twig', [
            'comments' => $this->getRepo(Comment::class)->findAll(),
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

        $entity = new Comment();
        $form = $this->createForm(CommentType::class, $entity);
        $form->add('submit', SubmitType::class, ['label' => 'Create']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entity->setProject($request->get('_project'));
            $em->persist($entity);
            $em->flush();
            $this->addFlash('success', 'successful.create');

            return $this->redirectToRoute('comments');
        }

        return $this->render('NotifyAppBundle:Comment:new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @param Comment $entity
     *
     * @return Response
     */
    public function editAction(Request $request, Comment $entity)
    {
        $em = $this->getEm();
        $form = $this->createForm(CommentType::class, $entity);
        $form->add('submit', SubmitType::class, ['label' => 'Update']);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($entity);
            $em->flush();
            $this->addFlash('success', 'successful.update');

            return $this->redirectToRoute('comment_edit', ['id' => $entity->getId()]);
        }

        return $this->render('NotifyAppBundle:Comment:edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Comment $entity
     *
     * @return RedirectResponse
     */
    public function removeAction(Comment $entity)
    {
        $em = $this->getEm();
        $em->remove($entity);
        $em->flush();
        $this->addFlash('success', 'successful.remove');

        return $this->redirectToRoute('comments');
    }

    /**
     * @param Comment $entity
     *
     * @return Response
     */
    public function showAction(Comment $entity)
    {
        return $this->render('NotifyAppBundle:Comment:show.html.twig', [
            'entity' => $entity,
        ]);
    }

    /**
     * @param Comment $comment
     *
     * @return Response
     */
    public function getCodeAction(Comment $comment)
    {
        if ($comment->getConsoleLog()) {
            $comment->setConsoleLog('true');
        } else {
            $comment->setConsoleLog('false');
        }

        return $this->render('NotifyAppBundle:Comment:getCode.html.twig', [
            'comment' => $comment,
        ]);
    }
}
