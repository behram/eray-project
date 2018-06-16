<?php

namespace Notify\AppBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use Notify\AppBundle\Entity\App;
use Notify\AppBundle\Entity\Tracker;
use Notify\CreditBundle\Entity\Credit;
use Notify\EventBundle\Entity\Filter;
use Notify\EventBundle\Entity\MailTemplate;
use Notify\EventBundle\Entity\NotyBox;
use Notify\EventBundle\Entity\Schedule;
use Notify\ListBundle\Entity\MailGroup;
use Notify\ListBundle\Entity\SmsGroup;
use Notify\ProjectBundle\Entity\Project;
use Notify\UserBundle\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class ProjectRelationsFixer
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
     * @var SampleObjectLoader
     */
    private $objectLoader;

    /**
     * @var Project
     */
    private $project;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @param EntityManagerInterface $em
     */
    public function setEm(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->objectLoader = new SampleObjectLoader($em);
    }

    public function normalizeProjectRelations(Project $project)
    {
        $this->project = $project;
        $this->normalizeApp();
        $this->normalizeTracker();
        $this->normalizeFilter();
        $this->normalizeSchedule();
        $this->normalizeNotyBox();
        $this->normalizeSmsGroup();
        $this->normalizeMailGroup();
        $this->normalizeMailTemplate();
        $this->normalizeCredit();
        $this->em->flush();
    }

    private function normalizeApp()
    {
        $app = $this->em->getRepository(App::class)->findOneBy([
            'project' => $this->project,
        ]);
        if($app){
            return;
        }
        $this->objectLoader->loadApp($this->project);
    }

    private function normalizeTracker()
    {
        $tracker = $this->em->getRepository(Tracker::class)->findOneBy([
            'project' => $this->project,
        ]);
        if($tracker){
            return;
        }
        $this->objectLoader->loadTracker($this->project);
    }

    private function normalizeFilter()
    {
        $filter = $this->em->getRepository(Filter::class)->findOneBy([
            'project' => $this->project,
        ]);
        if($filter){
            return;
        }
        $this->objectLoader->loadFilter($this->project);
    }

    private function normalizeSchedule()
    {
        $schedule1 = new Schedule();
        $schedule1->setName('Default - Every New User');
        $schedule1->setPublishType('everyNewUser');
        $schedule1->setIsForWeb(1);
        $schedule1->setProject($this->project);
        $schedule1->setIsDefault(true);
        $this->em->persist($schedule1);

        $schedule2 = new Schedule();
        $schedule2->setName('Default - Every Opened Page');
        $schedule2->setIsForWeb(1);
        $schedule2->setPublishType('everyOpenedPage');
        $schedule2->setProject($this->project);
        $schedule2->setIsDefault(true);
        $this->em->persist($schedule2);

        $schedule3 = new Schedule();
        $schedule3->setName('Default - Right Now');
        $schedule3->setIsForWeb(0);
        $schedule3->setPublishType('rightNow');
        $schedule3->setProject($this->project);
        $schedule3->setIsDefault(true);
        $this->em->persist($schedule3);
    }

    private function normalizeNotyBox()
    {
        $notyBox = $this->em->getRepository(NotyBox::class)->findOneBy([
            'project' => $this->project,
        ]);
        if($notyBox){
            return;
        }
        $this->objectLoader->loadNotyBox($this->project);
    }

    private function normalizeSmsGroup()
    {
        $smsGroup = $this->em->getRepository(SmsGroup::class)->findOneBy([
            'project' => $this->project,
        ]);
        if($smsGroup){
            return;
        }
        $this->objectLoader->loadSmsGroup($this->project);
    }

    private function normalizeMailGroup()
    {
        $mailGroup = $this->em->getRepository(MailGroup::class)->findOneBy([
            'project' => $this->project,
        ]);
        if($mailGroup){
            return;
        }
        $this->objectLoader->loadMailGroup($this->project);
    }

    private function normalizeMailTemplate()
    {
        $mailTemplate = $this->em->getRepository(MailTemplate::class)->findOneBy([
            'project' => $this->project,
        ]);
        if($mailTemplate){
            return;
        }
        $this->objectLoader->loadMailTemplate($this->project);
    }

    private function normalizeCredit()
    {
        $credit = new Credit();
        $credit->setUser($this->tokenStorage->getToken()->getUser());
        $credit->setWebCredit(300);
        $credit->setSmsCredit(250);
        $credit->setMailCredit(200);
        $credit->setGcmCredit(100);
        $this->em->persist($credit);
    }
}
