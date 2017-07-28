<?php

/**
 * This file is part of the pushover package.
 *
 * (c) Massimo Naccari "maxowar"
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */


namespace Pushover\Command;


use Pushover\Configuration;
use Pushover\Message;
use Pushover\Pushover;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MessageCommand extends Command
{
    public function configure()
    {
        $this
            ->setName('message:push')
            ->addOption(
                'message',
                'm',
                InputOption::VALUE_REQUIRED,
                'The message'
            )
            ->addOption(
                'title',
                't'
            )
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $configurationFile = getcwd() . "/.pushover";

        if(!file_exists($configurationFile)) {
            $command = $this->getApplication()->find('pushover:install');
            $command->run(new ArrayInput([]), $output);
        }

        require getcwd() . "/.pushover";

        $configuration = new Configuration(PUSHOVER_APP_TOKEN, PUSHOVER_USER_KEY);

        $pushover = new Pushover($configuration);

        $message = new Message($input->getOption('message'));
        if($input->getOption('title')) {
            $message->setTitle($input->getOption('message'));
        }

        $pushover->send($message);
    }
}