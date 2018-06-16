<?php

namespace Notify\AppBundle\Controller;

use Notify\AppBundle\Entity\App;
use Notify\AppBundle\Form\AppType;
use Notify\Common\Controller\NotifyController as Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AppController
 * @package Notify\AppBundle\Controller
 */
class AppController extends Controller
{
    /**
     * @return Response
     */
    public function indexAction()
    {
        $apps = $this->getRepo(App::class)->findAll();

        return $this->render('NotifyAppBundle:App:apps.html.twig', [
            'apps' => $apps,
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
        $entity = new App();
        $form = $this->createForm(AppType::class, $entity);
        $form->add('submit', SubmitType::class, ['label' => 'Create']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entity->setProject($request->get('_project'));
            $em->persist($entity);
            $em->flush();

            return $this->redirectToRoute('apps');
        }

        return $this->render('NotifyAppBundle:App:new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @param App $entity
     *
     * @return RedirectResponse|Response
     */
    public function editAction(Request $request, App $entity)
    {
        $em = $this->getEm();
        $form = $this->createForm(AppType::class, $entity);
        $form->add('submit', SubmitType::class, ['label' => 'Update']);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'successful.update');

            return $this->redirectToRoute('apps');
        }
        return $this->render('NotifyAppBundle:App:edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param App $entity
     *
     * @return RedirectResponse
     */
    public function removeAction(App $entity)
    {
        $em = $this->getEm();
        $em->remove($entity);
        $em->flush();
        $this->addFlash('success', 'successful.delete');

        return $this->redirectToRoute('apps');
    }

    /**
     * @param App $entity
     *
     * @return Response
     */
    public function showAction(App $entity)
    {
        return $this->render('NotifyAppBundle:App:show.html.twig', [
            'entity' => $entity,
        ]);
    }

    /**
     * @return Response
     */
    public function getSdkAction()
    {
        return new Response('sdk page goes here!');
    }
}
