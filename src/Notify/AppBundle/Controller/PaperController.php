<?php

namespace Notify\AppBundle\Controller;

use Notify\AppBundle\Entity\Paper;
use Notify\AppBundle\Form\PaperType;
use Notify\Common\Controller\NotifyController as Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class PaperController
 * @package Notify\AppBundle\Controller
 */
class PaperController extends Controller
{
    /**
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $query = $request->get('q');
        if(empty($query)){
            $papers = $this->getRepo(Paper::class)->findAll();
        }else{
            $papers = $this->getRepo(Paper::class)->createQueryBuilder('o')
                ->andWhere('o.title LIKE :title')
                ->setParameter('title', '%'.$query.'%')
                ->getQuery()
                ->getResult();
        }
        return $this->render('NotifyAppBundle:Paper:papers.html.twig', [
            'papers' => $papers,
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

        $entity = new Paper();
        $form = $this->createForm(PaperType::class, $entity);
        $form->add('submit', SubmitType::class, ['label' => 'Create']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entity->setProject($request->get('_project'));
            $em->persist($entity);
            $em->flush();
            $this->addFlash('success', 'successful.create');

            return $this->redirectToRoute('papers');
        }

        return $this->render('NotifyAppBundle:Paper:new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @param Paper $entity
     *
     * @return Response
     */
    public function editAction(Request $request, Paper $entity)
    {
        $em = $this->getEm();
        $form = $this->createForm(PaperType::class, $entity);
        $form->add('submit', SubmitType::class, ['label' => 'Update']);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($entity);
            $em->flush();
            $this->addFlash('success', 'successful.update');

            return $this->redirectToRoute('paper_edit', ['id' => $entity->getId()]);
        }

        return $this->render('NotifyAppBundle:Paper:edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Paper $entity
     *
     * @return RedirectResponse
     */
    public function removeAction(Paper $entity)
    {
        $em = $this->getEm();
        $em->remove($entity);
        $em->flush();
        $this->addFlash('success', 'successful.remove');

        return $this->redirectToRoute('papers');
    }

    /**
     * @param Paper $entity
     *
     * @return Response
     */
    public function showAction(Paper $entity)
    {
        return $this->render('NotifyAppBundle:Paper:show.html.twig', [
            'entity' => $entity,
        ]);
    }
}
