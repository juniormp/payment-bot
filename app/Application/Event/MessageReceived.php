<?php


namespace App\Application\Event;


use Illuminate\Queue\SerializesModels;

class MessageReceived
{
    use SerializesModels;

    public $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }
}
