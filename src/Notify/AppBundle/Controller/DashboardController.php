<?php

namespace Notify\AppBundle\Controller;

use Notify\Common\Controller\NotifyController as Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DashboardController
 * @package Notify\AppBundle\Controller
 */
class DashboardController extends Controller
{
    /**
     * @return Response
     */
    public function indexAction()
    {
        return $this->render('@NotifyApp/Dashboard/index.html.twig');
    }

    /**
     * @return Response
     */
    public function tryDemoAction()
    {
        return $this->render('NotifyEventBundle:Event:tryDemo.html.twig');
    }
}
