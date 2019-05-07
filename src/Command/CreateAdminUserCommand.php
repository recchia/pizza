<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateAdminUserCommand extends Command
{
    protected static $defaultName = 'app:create-admin-user';

    /**
     * @var UserPasswordEncoderInterface
     */
    protected $passwordEncoder;

    /**
     * @var EntityManagerInterface
     */
    protected $manager;

    /**
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * @var string
     */
    protected $errorMessage;

    /**
     * CreateAdminUserCommand constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param EntityManagerInterface $manager
     * @param ValidatorInterface $validator
     */
    public function __construct(
        UserPasswordEncoderInterface $passwordEncoder,
        EntityManagerInterface $manager,
        ValidatorInterface $validator
    )
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->manager = $manager;
        $this->validator = $validator;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Create Admin User')
            ->addArgument('email', InputArgument::REQUIRED, 'email')
            ->addArgument('password', InputArgument::REQUIRED, 'password')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $email = $input->getArgument('email');
        $password = $input->getArgument('password');

        if ($this->isValidEmail($email)) {
            $this->createAdminUser($email, $password);
            $io->success('You have created a new User with email ' . $email);
        } else {
            $io->error($this->errorMessage);
        }
    }

    /**
     * Create Admin User
     *
     * @param string $email
     * @param string $password
     */
    protected function createAdminUser(string $email, string $password): void
    {
        $user = new User();
        $user->setEmail($email);
        $user->setPassword($this->passwordEncoder->encodePassword($user, $password));
        $user->setRoles(['ROLE_ADMIN']);

        $this->manager->persist($user);
        $this->manager->flush();
    }

    /**
     * Validate email
     *
     * @param string $email
     * @return bool
     */
    protected function isValidEmail(string $email): bool
    {
        $emailConstraint = new Email();
        $emailConstraint->message = 'Invalid email address';

        $errors = $this->validator->validate($email, $emailConstraint);

        if (0 !== count($errors)) {
            $this->errorMessage = $errors[0]->getMessage();

            return false;
        }

        return true;
    }
}
