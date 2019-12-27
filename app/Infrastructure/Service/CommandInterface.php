<?php


namespace App\Infrastructure\Service;


interface CommandInterface
{
    public function perform(array $data);
}
