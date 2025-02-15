<?php


namespace Tests\Integration;


use App\Infrastructure\Service\TelegramService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Longman\TelegramBot\Telegram;
use Mockery;
use Tests\TestCase;

class CreateProductIntegrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_should_create_a_product()
    {
        $telegramService = new TelegramService();
        $telegram = Mockery::mock(Telegram::class);

        $telegram->shouldReceive('handle')->andReturn($this->response());

        $telegramService->webhook($telegram);

        $this->assertDatabaseHas('products', [
            'name' => 'BoiaFlamingoRosa',
            'amount' => 399.99,
            'quantity' => 5,
            'url' => 'https://i.ibb.co/gvBWCz7/rosa-flamingo.jpg'
        ]);
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
