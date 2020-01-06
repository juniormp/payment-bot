<?php


namespace Tests\Infrastucture\Service;


use App\Application\Event\MessageReceived;
use App\Infrastructure\Service\TelegramService;
use Illuminate\Support\Facades\Event;
use Longman\TelegramBot\Telegram;
use Mockery;
use Tests\TestCase;

class TelegramServiceTest extends TestCase
{
    public function test_should_build_telegram_object()
    {
        $this->markTestSkipped();
        $telegramService = new TelegramService();
        $telegram = Mockery::mock(Telegram::class);
        $this->app->bind(Telegram::class, function () use ($telegram) {
            return $telegram;
        });

        $response = $telegramService->getTelegram();

        $this->assertEquals($telegram, $response);
    }

    public function test_should_dispatcher_message_received_event()
    {
        Event::fake();
        $telegramService = new TelegramService();
        $telegram = Mockery::mock(Telegram::class);
        $telegram->shouldReceive('handle')->andReturn($this->response());
        $messageReceived = new MessageReceived($this->response());

        $telegramService->webhook($telegram);

        Event::assertDispatched(MessageReceived::class, function ($event) use ($messageReceived) {
            return $event == $messageReceived;
        });
    }

    public function response()
    {
        return array(
            'update_id' => 919483822,
            'message' =>
                array(
                    'message_id' => 1441,
                    'from' =>
                        array(
                            'id' => 462914579,
                            'is_bot' => false,
                            'first_name' => 'Maurício',
                            'last_name' => 'Junior',
                            'username' => 'juniormp',
                            'language_code' => 'en',
                        ),
                    'chat' =>
                        array(
                            'id' => 462914579,
                            'first_name' => 'Maurício',
                            'last_name' => 'Junior',
                            'username' => 'juniormp',
                            'type' => 'private',
                        ),
                    'date' => 1578275063,
                    'text' => '/novoproduto BoiaFlamingoRosa 399.99 5 https://i.ibb.co/gvBWCz7/rosa-flamingo.jpg',
                    'entities' =>
                        array(
                            0 =>
                                array(
                                    'offset' => 0,
                                    'length' => 12,
                                    'type' => 'bot_command',
                                ),
                            1 =>
                                array(
                                    'offset' => 39,
                                    'length' => 42,
                                    'type' => 'url',
                                ),
                        ),
                ),
        );
    }
}


