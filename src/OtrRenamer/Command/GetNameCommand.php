<?php
/**
 * Created by PhpStorm.
 * User: basster
 * Date: 25.11.2014
 * Time: 23:15
 */

namespace OtrRenamer\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;

class GetNameCommand extends Command {
    const COMMAND_NAME = 'get:filename';

    protected function configure()
    {
        $this
            ->setName(self::COMMAND_NAME)
            ->setDescription('Retrieves a episode name from fernsehserien.de')
            ->addArgument(
                'filename',
                InputArgument::REQUIRED,
                'The full filename of the otrkey file.'
            )
        ;
    }
} 