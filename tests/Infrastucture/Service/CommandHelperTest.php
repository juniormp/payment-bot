<?php


namespace Tests\Infrastucture\Service;


use App\Infrastructure\Service\CommandHelper;
use Tests\TestCase;

class CommandHelperTest extends TestCase
{
    public function test_return_validated_command_data()
    {
        $data = $this->data();
        $commandHelper = new CommandHelper();
        $expected = array(
            0 => "/novoproduto",
            1 => "BoiaFlamingoRosa",
            2 => "399.99",
            3 => "5",
            4 => "https://i.ibb.co/gvBWCz7/rosa-flamingo.jpg"
        );

        $response = $commandHelper->validate($data, CommandHelper::CREATE_PRODUCT);

        $this->assertEquals($expected, $response);
    }

    public function test_return_empty_command_data()
    {
        $data = $this->data();
        $commandHelper = new CommandHelper();

        $response = $commandHelper->validate($data, '/fake-command');

        $this->assertEquals([], $response);
    }

    public function data()
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
