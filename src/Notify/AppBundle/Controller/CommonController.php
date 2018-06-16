<?php

namespace Notify\AppBundle\Controller;

use Notify\Common\Controller\NotifyController as Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CommonController
 * @package Notify\AppBundle\Controller
 */
class CommonController extends Controller
{
    /**
     * @param $code
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function changeLocaleAction($code, Request $request)
    {
        $request->setLocale($code);
        $this->get('session')->set('_locale', $code);

        return $this->redirectToRoute('decide_project');
    }
}
