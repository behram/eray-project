<?php

namespace Notify\AppBundle\Controller;

use Notify\Common\Controller\NotifyController as Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class ExportController
 * @package Notify\AppBundle\Controller
 */
class ExportController extends Controller
{
    /**
     * @return Response
     */
    public function cdnScriptAction()
    {
        $kernel = $this->get('kernel');
        //main user track cdn ut.js file
        $mainCdnUserTrackFile = $kernel->getRootDir().'/../web/cdn/js/ut.js';
        $this->cdnLibAction();
        $cdnContent = file_get_contents($mainCdnUserTrackFile);

        return new Response($cdnContent, 200, [
            'Content-Type' => 'application/javascript',
        ]);
    }

    /**
     * exports main user track cdn js file
     * implodes needed files to one file.
     *
     * @return JsonResponse
     */
    public function cdnLibAction()
    {
        $tornadoPort = $this->container->getParameter('tornado_port');
        $homeFullUrl = $this->generateUrl('notify_homepage', [], UrlGeneratorInterface::ABSOLUTE_URL);
        $rootAdress = preg_replace('/app_dev.php\//', '', $homeFullUrl);
        $rootDir = $this->get('kernel')->getRootDir();

        //main user track cdn ut.js file
        $mainCdnUserTrackFile = $rootDir.'/../web/cdn/js/ut.js';

        //specify that will implode
        $scripts['jquery'] = $rootDir.'/../web/cdn/js/jquery-1.11.2.min.js';
        $scripts['noty'] = $rootDir.'/../web/cdn/js/jquery.noty.js';
        $scripts['isJs'] = $rootDir.'/../web/cdn/js/is.min.js';
        $scripts['utJs'] = $rootDir.'/../web/cdn/js/ut.core.js';

        //implode all files
        $putFile = 'var TRACK_DOMAIN = "'.$rootAdress.'";';
        $putFile = $putFile.'var TRACK_HOME_URL = "'.$homeFullUrl.'";';
        $putFile = $putFile.'var WEBSOCKET_URL = "ws://'.$this->getParameter('base_host').':'.$tornadoPort.'/notifyWsControl";';
        foreach ($scripts as $script) {
            $getContent = file_get_contents($script);

            $putFile = $putFile.$getContent.";\n\n";
        }

        //put compiled files to main file
        file_put_contents($mainCdnUserTrackFile, $putFile);

        return new JsonResponse(['process' => 'ok']);
    }

    /**
     * If you work on cdn client side js file
     * updates main cdn file every second.
     */
    public function exportWatchAction()
    {
        foreach (range(1, 1000) as $v) {
            sleep(1);
            $this->cdnLibAction();
        }
    }
}
