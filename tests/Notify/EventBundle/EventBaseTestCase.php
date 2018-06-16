<?php

namespace Tests\Notify\EventBundle;

use Notify\AppBundle\Entity\App;
use Notify\AppBundle\Entity\Tracker;
use Notify\EventBundle\Entity\Filter;
use Notify\EventBundle\Entity\MailTemplate;
use Notify\EventBundle\Entity\NotyBox;
use Notify\EventBundle\Entity\Schedule;
use Notify\ListBundle\Entity\MailGroup;
use Notify\ListBundle\Entity\MailList;
use Notify\ListBundle\Entity\PhoneList;
use Notify\ListBundle\Entity\SmsGroup;
use Tests\BaseTestSetup;

class EventBaseTestCase extends BaseTestSetup
{
    public function setupTracker()
    {
        $project = $this->getUserProject();
        $tracker = $this->em->getRepository(Tracker::class)->findOneBy([
            'project' => $project,
        ]);
        if($tracker){
            return;
        }
        $this->sampleObjectLoader->loadTracker($project);
    }

    public function setupApp()
    {
        $project = $this->getUserProject();
        $app = $this->em->getRepository(App::class)->findOneBy([
            'project' => $project,
        ]);
        if($app){
            return;
        }
        $this->sampleObjectLoader->loadApp($project);
    }

    public function setupNotyBox()
    {
        $project = $this->getUserProject();
        $notyBox = $this->em->getRepository(NotyBox::class)->findOneBy([
            'project' => $project,
        ]);
        if($notyBox){
            return;
        }
        $this->sampleObjectLoader->loadNotyBox($project);
    }

    public function setupFilter()
    {
        $project = $this->getUserProject();
        $filter = $this->em->getRepository(Filter::class)->findOneBy([
            'project' => $project,
        ]);
        if($filter){
            return;
        }
        $this->sampleObjectLoader->loadFilter($project);
    }

    public function setupSchedule()
    {
        $project = $this->getUserProject();
        $schedule = $this->em->getRepository(Schedule::class)->findOneBy([
            'project' => $project,
        ]);
        if($schedule){
            return;
        }
        $this->sampleObjectLoader->loadSchedule($project);
    }

    public function setupMailTemplate()
    {
        $project = $this->getUserProject();
        $mailTemplate = $this->em->getRepository(MailTemplate::class)->findOneBy([
            'project' => $project,
        ]);
        if($mailTemplate){
            return;
        }
        $this->sampleObjectLoader->loadMailTemplate($project);
    }

    public function setupPhoneNumber()
    {
        $project = $this->getUserProject();
        $phoneNumber = $this->em->getRepository(PhoneList::class)->findOneBy([
            'project' => $project,
        ]);
        if($phoneNumber){
            return;
        }
        $this->sampleObjectLoader->loadPhoneNumber($project);
    }

    public function setupPhoneGroup()
    {
        $project = $this->getUserProject();
        $smsGroup = $this->em->getRepository(SmsGroup::class)->findOneBy([
            'project' => $project,
        ]);
        if($smsGroup){
            return;
        }
        $this->sampleObjectLoader->loadSmsGroup($project);
    }

    public function setupMail()
    {
        $project = $this->getUserProject();
        $mail = $this->em->getRepository(MailList::class)->findOneBy([
            'project' => $project,
        ]);
        if($mail){
            return;
        }
        $this->sampleObjectLoader->loadMail($project);
    }

    public function setupMailGroup()
    {
        $project = $this->getUserProject();
        $mailGroup = $this->em->getRepository(MailGroup::class)->findOneBy([
            'project' => $project,
        ]);
        if($mailGroup){
            return;
        }
        $this->sampleObjectLoader->loadMailGroup($project);
    }
}
