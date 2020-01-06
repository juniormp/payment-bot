<?php


namespace App\Infrastructure\Service;


class CommandHelper
{
    const CREATE_PRODUCT = '/novoproduto';

    public function validate($data, $command): array
    {
        if($this->commandExist($data)){
            $action = explode(" ", $data['message']['text']);

            if($action[0] == $command){
                return $action;
            }else {
                return [];
            }
        }
    }

    private function commandExist($data){
        $message = array_key_exists('message', $data);

        if ($message) {
            $text = array_key_exists('text', $data['message']);
        } else {
            $text = false;
        }

        return  $message && $text;
    }
}
