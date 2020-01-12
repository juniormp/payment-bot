<?php


namespace Tests\Integration;


use App\Domain\Product;
use App\Infrastructure\Service\TelegramService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Longman\TelegramBot\Telegram;
use Mockery;
use Tests\TestCase;

class DeleteProductIntegrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_should_delete_a_product()
    {
        $product = factory(Product::class)->create();
        $telegramService = new TelegramService();
        $telegram = Mockery::mock(Telegram::class);

        $telegram->shouldReceive('handle')->andReturn($this->response());

        $telegramService->webhook($telegram);

        $this->assertDatabaseMissing('products', [
            'name' => $product->name,
            'amount' => $product->amount,
            'quantity' => $product->quantity,
            'url' => $product->url
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
                    'text' => '/excluirproduto 1',
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
