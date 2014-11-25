<?php

namespace Test\OtrRenamer;


use OtrRenamer\Application;
use OtrRenamer\Command\GetNameCommand;

class ApplicationTest extends \PHPUnit_Framework_TestCase {

    /**
     * @dataProvider provideCommands
     * @param $commandName
     */
    public function testHasCommands($commandName)
    {
        $app = new Application();
        $this->assertTrue($app->has($commandName));
    }

    public function provideCommands(){
        return [
            [GetNameCommand::COMMAND_NAME],
        ];
    }
}
 