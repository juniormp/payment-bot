<?php


namespace Tests\Infrastucture\Service;


use App\Infrastructure\Service\TelegramService;
use Longman\TelegramBot\Telegram;
use Tests\TestCase;

class TelegramServiceTest extends TestCase
{
    public function test_foo()
    {
        dd($this->response()['message']['text']);

        $this->assertTrue(true);
    }

    public function test_should_build_telegram_object()
    {

    }

    public function test_should_delivery_requests_to_command(){



    }


    public function response(){
        return array (
            'update_id' => 919483609,
            'message' =>
                array (
                    'message_id' => 767,
                    'from' =>
                        array (
                            'id' => 462914579,
                            'is_bot' => false,
                            'first_name' => 'Maurício',
                            'last_name' => 'Junior',
                            'username' => 'juniormp',
                            'language_code' => 'en',
                        ),
                    'chat' =>
                        array (
                            'id' => 462914579,
                            'first_name' => 'Maurício',
                            'last_name' => 'Junior',
                            'username' => 'juniormp',
                            'type' => 'private',
                        ),
                    'date' => 1577276848,
                    'text' => '/start',
                    'entities' =>
                        array (
                            0 =>
                                array (
                                    'offset' => 0,
                                    'length' => 6,
                                    'type' => 'bot_command',
                                ),
                        ),
                ),
        );
    }
}


