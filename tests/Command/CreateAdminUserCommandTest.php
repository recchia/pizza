<?php


namespace App\Tests\Command;


use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class CreateAdminUserCommandTest extends KernelTestCase
{
    protected $manager;

    public function testCheckValidEmail(): void
    {
        $kernel = static::createKernel();
        $application = new Application($kernel);

        $command = $application->find('app:create-admin-user');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'command' => $command->getName(),
            'email' => 'not_email',
            'password' => 'password',
        ]);

        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('Invalid email address', $output);
    }

}