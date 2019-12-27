<?php


namespace Tests\Infrastucture\Service;


use App\Application\CreateProduct;
use App\Infrastructure\Exception\NewProductException;
use App\Infrastructure\Service\CommandStrategy;
use App\Infrastructure\Service\CommandContext;
use Mockery;
use Tests\TestCase;

class CommandStrategyTest extends TestCase
{
    public function test_should_redirect_to_create_product()
    {
        $data = array (
            'message' => array (
                'text' => '/novoproduto BoiaDeFlamingoRosa 399.99 5 https://i.ibb.co/gvBWCz7/rosa-flamingo.jpg',
            )
        );
        $commandContext = Mockery::spy(CommandContext::class);
        $createProduct = new CreateProduct();
        $command = new CommandStrategy($commandContext);

        $commandContext->shouldReceive('setStrategy')
            ->with(\Mockery::on(function($arg) use($createProduct) {
                return $arg == $createProduct;
            }))->once();

        $commandContext->shouldReceive('perform')
            ->with(\Mockery::on(function($arg) use($data) {
                return $arg == explode(" ", $data['message']['text']);
            }))->once();

        $command->handle($data);
    }

    public function test_should_throw_exception_for_empty_new_product_command()
    {
        $data = array (
            'message' => array (
                'text' => '/novoproduto https://i.ibb.co/gvBWCz7/rosa-flamingo.jpg',
            )
        );
        $commandContext = new CommandContext();
        $command = new CommandStrategy($commandContext);

        $this->expectException(NewProductException::class);

        $command->handle($data);
    }
}
