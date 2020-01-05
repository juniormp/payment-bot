<?php


namespace App\Domain;


use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    private $name;
    private $quantity;
    private $amount;
    private $url;

}
