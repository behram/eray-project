<?php

namespace Tests;

use FOS\UserBundle\Model\UserManagerInterface;
use Liip\FunctionalTestBundle\Test\WebTestCase;
use Notify\AppBundle\Service\SampleObjectLoader;
use Notify\ProjectBundle\Entity\Project;
use Notify\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Client;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Routing\RouterInterface;

class BaseTestSetup extends WebTestCase
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * @var  Client
     */
    protected $client;

    /**
     * @var  EntityManager
     */
    protected $em;

    /**
     * @var  SampleObjectLoader
     */
    protected $sampleObjectLoader;

    /**
     * @var  RouterInterface
     */
    protected $router;

    /**
     * @var string
     */
    protected $testUsername = 'test_user';

    /**
     * @var string
     */
    protected $testPassword = 'test_password';

    /**
     * @var User
     */
    protected $user = null;

    /**
     * @var Project
     */
    protected $project = null;

    protected function setUp()
    {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $container = static::$kernel->getContainer();

        $this->em = $container->get('doctrine')->getManager();
        $this->sampleObjectLoader = $container->get('notify_app.sample.object_loader');
        $this->router = $container->get('router');
        $baseUrl = $container->getParameter('base_host');
        $this->client = static::makeClient(array(),array('HTTP_HOST' => $baseUrl));

        $this->app = new Application($this->client->getKernel());
        $this->app->setAutoExit(false);
    }

    /**
     * @param $command
     * @param array $options
     * @return integer
     */
    protected function runConsole($command, Array $options = array())
    {
        $options["--env"] = "test";
        $options["--quiet"] = null;
        $options["--no-interaction"] = null;
        $options = array_merge($options, array('command' => $command));

        return $this->app->run(new ArrayInput($options));
    }

    protected function createTestUser()
    {
        /** @var $userManager UserManagerInterface */
        $userManager = $this->getContainer()->get('fos_user.user_manager');
        $findUser = $this->em->getRepository(User::class)->findOneBy([
            'username' => $this->testUsername,
        ]);
        if($findUser){
            $this->user = $findUser;
            return;
        }
        /** @var User $user */
        $user = $userManager->createUser();
        $user
            ->setEnabled(true)
            ->setUsername($this->testUsername)
            ->setPlainPassword($this->testPassword)
            ->setEmail($this->testUsername.'@behram.org')
        ;

        $userManager->updateUser($user);
    }

    protected function logIn($username = null, $password = null)
    {
        if(empty($password) && empty($password)){
            $this->createTestUser();
        }
        if(empty($username)){
            $username = $this->testUsername;
        }
        if(empty($password)){
            $password = $this->testPassword;
        }
        $this->client->setServerParameter('PHP_AUTH_USER', $username);
        $this->client->setServerParameter('PHP_AUTH_PW', $password);
    }

    protected function getUserProject()
    {
        $this->logIn();
        if($this->project instanceof Project){
            return $this->project;
        }
        $findProject = $this->em->getRepository(Project::class)->findOneBy([
            'user' => $this->user,
        ]);
        if($findProject){
            return $findProject;
        }
        $project = new Project();
        $project
            ->setProjectName('Big Project')
            ->setSlug('hash1234')
            ->setUser($this->user)
            ;
        $this->em->persist($project);
        $this->em->flush();

        return $project;
    }

    public function getProjectPath(string $path)
    {
        $this->logIn();
        $project = $this->getUserProject();
        $requestPath = sprintf('/project/%s/%s', $project->getId(), $path);
        $this->client->request('GET', $requestPath);

        $this->isSuccessful($this->client->getResponse());
    }

    protected function tearDown()
    {
        parent::tearDown();
        $this->em->close();
        $this->em = null;
        unset($this->client, $this->em);
    }
}
