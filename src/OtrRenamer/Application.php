<?php

namespace OtrRenamer;


use OtrRenamer\Command\GetNameCommand;
use Symfony\Component\Console\Application as BaseApplication;

class Application extends BaseApplication
{
    public function __construct()
    {
        parent::__construct('OTR-Renamer', '0.1.0');

        $this->initCommands();
    }

    private function initCommands()
    {
        $this->add(new GetNameCommand());
    }
} 