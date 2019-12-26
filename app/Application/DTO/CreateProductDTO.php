<?php


namespace App\Application\DTO;


use Illuminate\Support\Facades\Log;

class CreateProductDTO
{
    private $clientId;
    private $productName;
    private $productPrice;
    private $productQuantity;
    private $productUrl;

    public function __construct(array $data)
    {
        $this->clientId = $data['message']['from']['id'];
        $data = $data['message']['text'];
        $new = explode(" ", $data);
        $this->productName = $new[1];
        $this->productPrice = $new[2];
        $this->productQuantity= $new[3];
        $this->productUrl = $new[4];
    }

    public function getClientId()
    {
        return $this->clientId;
    }

    public function getProductName()
    {
        return $this->productName;
    }

    public function getProductPrice()
    {
        return $this->productPrice;
    }

    public function getProductQuantity()
    {
        return $this->productQuantity;
    }

    public function getProductUrl()
    {
        return $this->productUrl;
    }


}
