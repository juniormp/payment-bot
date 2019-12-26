<?php


namespace App\Application;


use App\Infrastructure\Service\CommandInterface;
use Longman\TelegramBot\Request;

class CreateProduct implements CommandInterface
{
    public function perform(array $data)
    {
        dd(5);

    }
}
