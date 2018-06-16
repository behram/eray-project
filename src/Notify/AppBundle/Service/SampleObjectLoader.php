<?php

namespace Notify\AppBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use Notify\AppBundle\Entity\App;
use Notify\AppBundle\Entity\RegistrationId;
use Notify\AppBundle\Entity\Tracker;
use Notify\EventBundle\Entity\Event;
use Notify\EventBundle\Entity\Filter;
use Notify\EventBundle\Entity\MailTemplate;
use Notify\EventBundle\Entity\NotyBox;
use Notify\EventBundle\Entity\Schedule;
use Notify\ListBundle\Entity\MailGroup;
use Notify\ListBundle\Entity\MailList;
use Notify\ListBundle\Entity\PhoneList;
use Notify\ListBundle\Entity\SmsGroup;
use Notify\ProjectBundle\Entity\Project;

class SampleObjectLoader
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param Project $project
     *
     * @return App
     */
    public function loadApp(Project $project)
    {
        $entity = new App();
        $entity
            ->setProject($project)
            ->setAppName('Sample App')
            ->setIsOnline(true)
            ->setAppHash(bin2hex(random_bytes(4)))
            ->setLanguage('English')
            ->setRunTime(rand(1, 1000))
            ;
        $this->saveAndFlush($entity);

        return $entity;
    }

    /**
     * @param Project $project
     *
     * @return Tracker
     */
    public function loadTracker(Project $project)
    {
        $entity = new Tracker();
        $entity
            ->setProject($project)
            ->setTrackerName('Sample Tracker')
            ->setIsOnline(true)
            ->setTrackerHash(bin2hex(random_bytes(4)))
            ->setLanguage('English')
            ->setRunTime(rand(1, 1000))
            ->setConsoleLog(true)
        ;
        $this->saveAndFlush($entity);

        return $entity;
    }

    /**
     * @param Project $project
     *
     * @return NotyBox
     */
    public function loadNotyBox(Project $project)
    {
        $entity = new NotyBox();
        $entity
            ->setProject($project)
            ->setType('Warning')
            ->setLayout('Top Center')
            ->setName('Sample Test NotyBox')
        ;
        $this->saveAndFlush($entity);

        return $entity;
    }

    /**
     * @param Project $project
     *
     * @return Filter
     */
    public function loadFilter(Project $project)
    {
        $entity = new Filter();
        $entity
            ->setProject($project)
            ->setOnlyAdblocked(true)
            ->setOnMobile(false)
            ->setName('My Great Filter')
            ->setOnTablet(true)
            ->setOnDesktop(true)
        ;
        $this->saveAndFlush($entity);

        return $entity;
    }

    /**
     * @param Project $project
     *
     * @return Schedule
     */
    public function loadSchedule(Project $project)
    {
        $entity = new Schedule();
        $entity
            ->setProject($project)
            ->setName('My Test Schedule')
            ->setPublishTime(5)
            ->setPublishType('spesificTime')
            ->setIsDefault(false)
        ;
        $this->saveAndFlush($entity);

        return $entity;
    }

    /**
     * @param Project $project
     *
     * @return MailTemplate
     */
    public function loadMailTemplate(Project $project)
    {
        $entity = new MailTemplate();
        $entity
            ->setProject($project)
            ->setName('My Test Mail Template')
            ->setContent('Hello great content')
        ;
        $this->saveAndFlush($entity);

        return $entity;
    }

    /**
     * @param Project $project
     *
     * @return PhoneList
     */
    public function loadPhoneNumber(Project $project)
    {
        $entity = new PhoneList();
        $entity
            ->setProject($project)
            ->setPhoneNumber('234523452345')
            ->setName('Salim Selim')
            ->setSurname('ÇELEN')
        ;
        $this->saveAndFlush($entity);

        return $entity;
    }

    /**
     * @param Project $project
     *
     * @return RegistrationId
     */
    public function loadRegistrationId(Project $project)
    {
        $app = $this->loadApp($project);
        $entity = new RegistrationId();
        $entity
            ->setApp($app)
            ->setRegistrationId(bin2hex(random_bytes(20)))
        ;
        $this->saveAndFlush($entity);

        return $entity;
    }

    /**
     * @param Project $project
     *
     * @return MailList
     */
    public function loadMail(Project $project)
    {
        $entity = new MailList();
        $entity
            ->setProject($project)
            ->setMailAdress('behramcelen@gmail.com')
            ->setName('Salim Selim')
            ->setSurname('ÇELEN')
        ;
        $this->saveAndFlush($entity);

        return $entity;
    }

    /**
     * @param Project $project
     *
     * @return SmsGroup
     */
    public function loadSmsGroup(Project $project)
    {
        $number = $this->loadPhoneNumber($project);
        $entity = new SmsGroup();
        $entity
            ->setProject($project)
            ->setName('Sms Group')
            ->addSmsPhone($number)
        ;
        $this->saveAndFlush($entity);

        return $entity;
    }

    /**
     * @param Project $project
     *
     * @return MailGroup
     */
    public function loadMailGroup(Project $project)
    {
        $mail = $this->loadMail($project);
        $entity = new MailGroup();
        $entity
            ->setProject($project)
            ->setName('Sms Group')
            ->addMail($mail)
        ;
        $this->saveAndFlush($entity);

        return $entity;
    }

    /**
     * @param Project $project
     *
     * @return Event
     */
    public function loadEvent(Project $project)
    {
        $app = $this->loadApp($project);
        $schedule = $this->loadSchedule($project);
        $filter = $this->loadFilter($project);
        $entity = new Event();
        $entity
            ->setProject($project)
            ->setEventHash(bin2hex(random_bytes(10)))
            ->setApp($app)
            ->setSchedule($schedule)
            ->setFilter($filter)
            ->setEventType('gcm')
            ->setEventName('My Great Event')
            ->setEventText('Hello Great test content')
            ->setSeenCount(0)
        ;
        $this->saveAndFlush($entity);

        return $entity;
    }

    private function saveAndFlush($object)
    {
        $this->em->persist($object);
        $this->em->flush();
    }
}
