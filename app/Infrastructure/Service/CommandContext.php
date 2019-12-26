<?php


namespace App\Infrastructure\Service;


class CommandContext
{
    private $commandInterface;

    public function setStrategy(CommandInterface $commandInterface)
    {
        $this->commandInterface = $commandInterface;
    }

    public function perform(array $data)
    {
        $this->commandInterface->perform($data);
    }
}
