<?php


namespace App\Infrastructure\Helper;


class CommandHelper
{
    const CREATE_PRODUCT = '/novoproduto';
    const DELETE_PRODUCT = '/excluirproduto';

    public function validate($event, $command)
    {
        if($this->commandExist($event)){
            $action = explode(" ", $event->data['message']['text']);

            if($action[0] == $command){
                return $action;
            }else {
                return [];
            }
        }
    }

    private function commandExist($event){
        $message = array_key_exists('message', $event->data);

        if ($message) {
            $text = array_key_exists('text', $event->data['message']);
        } else {
            $text = false;
        }

        return  $message && $text;
    }
}
