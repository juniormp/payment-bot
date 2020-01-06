<?php


namespace App\Http\Controllers;

use App\Application\UseCase\HandleRequest;
use Illuminate\Routing\Controller;

class TelegramController extends Controller
{
    private $handleRequest;

    public function __construct(HandleRequest $handleRequest)
    {
        $this->handleRequest = $handleRequest;
    }

    public function handleRequest()
    {
        $this->handleRequest->perform();
    }
}
