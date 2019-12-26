<?php


namespace App\Application;


use App\Application\DTO\CreateProductDTO;
use App\Infrastructure\Service\CommandInterface;
use Illuminate\Support\Facades\Log;
use Longman\TelegramBot\Request;

class CreateProduct implements CommandInterface
{
    private $createProductDTO;

    public function __construct(array $data)
    {
        $this->createProductDTO = new CreateProductDTO($data);
    }

    public function perform()
    {
        // validator que lança exception para o telegram
        // salvar no repositorio
        // retorna para o telegram produto salvo

        $this->response($this->createProductDTO);
    }

    private function response(CreateProductDTO $createProductDTO){
        $message = "Produto criado com sucesso: " .
            "\n\n nome: {$createProductDTO->getProductName()}" .
            "\n valor: {$createProductDTO->getProductPrice()}" .
            "\n quantidade: {$createProductDTO->getProductQuantity()}" .
            "\n url: {$createProductDTO->getProductUrl()}";

        Request::sendSticker([
            'chat_id' => '462914579',
            'sticker' => 'CAADAgAD4wEAAsoDBgu8yHfqPBKwhRYE'
        ]);

        Request::sendMessage([
            'chat_id' => '462914579',
            'parse_mode' => 'markdown',
            'disable_web_page_preview' => true,
            'text' => $message
        ]);
    }
}
