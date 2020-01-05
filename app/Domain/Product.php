<?php


namespace App\Domain;


use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'name',
        'quantity',
        'amount',
        'url'
    ];
}
