<?php


namespace App\Infrastructure\Service;


use Illuminate\Support\Facades\Log;

class CommandContext implements CommandInterface
{
    private $commandInterface;

    public function setStrategy(CommandInterface $commandInterface)
    {
        $this->commandInterface = $commandInterface;
    }

    public function perform()
    {
        $this->commandInterface->perform();
    }
}
