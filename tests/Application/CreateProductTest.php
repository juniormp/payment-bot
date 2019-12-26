<?php


namespace Tests\Application;


use App\Application\CreateProduct;
use Tests\TestCase;

class CreateProductTest extends TestCase
{
    public function test_fuu()
    {
        $data = $this->response();
        $createProduct = new CreateProduct($data);

        $createProduct->perform();
    }

    public function response(){
        return array (
            'update_id' => 919483646,
            'message' =>
                array (
                    'message_id' => 839,
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
                    'date' => 1577286228,
                    'text' => '/novoproduto Boia 399.99 5 https://i.ibb.co/gvBWCz7/rosa-flamingo.jpg',
                    'entities' =>
                        array (
                            0 =>
                                array (
                                    'offset' => 0,
                                    'length' => 12,
                                    'type' => 'bot_command',
                                ),
                            1 =>
                                array (
                                    'offset' => 14,
                                    'length' => 1,
                                    'type' => 'code',
                                ),
                            2 =>
                                array (
                                    'offset' => 53,
                                    'length' => 42,
                                    'type' => 'url',
                                ),
                            3 =>
                                array (
                                    'offset' => 96,
                                    'length' => 1,
                                    'type' => 'code',
                                ),
                        ),
                ),
        );
    }
}
