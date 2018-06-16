<?php

namespace Notify\Common\Twig;

use Doctrine\ORM\EntityManagerInterface;
use Notify\EventBundle\Entity\Schedule;
use Notify\ProjectBundle\Entity\Project;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class NotifyExtension extends \Twig_Extension
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * NotifyExtension constructor.
     *
     * @param EntityManagerInterface $em
     * @param TokenStorageInterface  $tokenStorage
     */
    public function __construct(EntityManagerInterface $em, TokenStorageInterface $tokenStorage)
    {
        $this->em = $em;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('url_decode', [$this, 'urlDecode']),
            new \Twig_SimpleFilter('event_publish_details', [$this, 'eventPublishDetails']),
            new \Twig_SimpleFilter('boolen_to_icon', [$this, 'boolenToIcon']),
        );
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('isProjectsPage', [$this, 'isProjectsPage']),
            new \Twig_SimpleFunction('currentTracker', [$this, 'currentTracker']),
            new \Twig_SimpleFunction('userTime', [$this, 'userTimeDedect']),
            new \Twig_SimpleFunction('userprojects', [$this, 'getUserProjects', ['is_safe' => ['html']]]),
        );
    }

    /**
     * URL Decode a string.
     *
     * @param string $url
     *
     * @return string The decoded URL
     */
    public function urlDecode($url)
    {
        return urldecode($url);
    }

    /**
     * URL Decode a string.
     *
     * @param Schedule $schedule
     *
     * @return string The decoded URL
     */
    public function eventPublishDetails(Schedule $schedule)
    {
        $rData['title'] = '';
        switch ($schedule->getPublishType()) {
            case 'rightNow':

                $rData['title'] = 'on '.$schedule->getPublishTime();
                $rData['text'] = 'Right now';
                break;
            case 'everyNewUser':

                $rData['text'] = 'Every new user';
                break;
            case 'everyOpenedPage':

                $rData['text'] = 'Every opened page';
                break;
            case 'spesificTime':

                if (preg_match('/today/', $schedule->getSpesifictimeDayFilter())) {
                    $explode = explode(',', $schedule->getSpesifictimeDayFilter());
                    $rData['title'] = 'Today<br> on '.$explode[1].' '.$schedule->getSpesifictimeTime();
                } elseif ($schedule->getSpesifictimeDayFilter() === 'everyday') {
                    $rData['title'] = 'Everyday<br> on '.$schedule->getSpesifictimeTime();
                } elseif ($schedule->getSpesifictimeDayFilter() === 'select_days') {
                    $days = implode(',', $schedule->getSpesifictimeSelectDaysDecoded());
                    $rData['title'] = 'Selected Days<br> days = '.$days.'<br>time = '.$schedule->getSpesifictimeTime();
                }
                $rData['text'] = 'Spesific Time';
                break;
            case 'everySpesificHour':

                $rData['title'] = 'Every '.$schedule->getEveryspesifichourHour().' one time';
                $rData['text'] = 'Every Spesific Hour';
                break;
        }

        return $rData;
    }

    public function boolenToIcon($boolean)
    {
        if ($boolean) {
            return '<i class="ace-icon fa fa-check bigger-110 green"></i>';
        } else {
            return '<i class="ace-icon fa fa-times bigger-110 red"></i>';
        }
    }

    public function isProjectsPage()
    {
        if (preg_match('@projects@i', $_SERVER['REQUEST_URI'])) {
            return true;
        } else {
            return false;
        }
    }

    public function userTimeDedect()
    {
        $user = $this->tokenStorage->getToken()->getUser();
        $offsetTime = 60 * intval($user->getClientTimeOffset());
        $rData['userTimestamp'] = time() - $offsetTime;
        $rData['userTime'] = date('H:i:s', $rData['userTimestamp']);

        return $rData;
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'app_extension';
    }

    /**
     * @return mixed
     */
    public function getUserProjects()
    {
        return $this->em->getRepository(Project::class)->findBy([
            'user' => $this->tokenStorage->getToken()->getUser(),
        ]);
    }
}
