<?php


namespace Tests\Application;


use App\Application\UseCase\HandleWebhook;
use App\Infrastructure\Service\TelegramService;
use Longman\TelegramBot\Telegram;
use Mockery;
use Tests\TestCase;

class HandleWebhookTest extends TestCase
{
    public function test_should_handle_webhook()
    {
        $telegramService = Mockery::mock(TelegramService::class);
        $handleWebhook = new HandleWebhook($telegramService);
        $telegram = Mockery::mock(Telegram::class);

        $telegramService->shouldReceive('getTelegram')
            ->andReturn($telegram)
            ->once();
        $telegramService->shouldReceive('webhook')
            ->with(
                Mockery::on(function ($arg) use ($telegram) {
                    return $arg === $telegram;
                }))
            ->once();

        $handleWebhook->perform();
    }
}
