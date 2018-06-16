<?php

namespace Notify\HomeBundle\Controller;

use Notify\Common\Controller\NotifyController as Controller;

class HomeController extends Controller
{
    public function indexAction()
    {
        return $this->render('NotifyHomeBundle:Home:home.html.twig');
    }

    public function contactAction()
    {
        return $this->render('NotifyHomeBundle:Home:contact.html.twig');
    }

    public function featuresAction()
    {
        return $this->render('NotifyHomeBundle:Home:features.html.twig');
    }

    public function testTrackerAction()
    {
        return $this->render('NotifyHomeBundle:Home:test_tracker.html.twig');
    }
}
