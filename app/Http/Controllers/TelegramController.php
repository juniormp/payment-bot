<?php


namespace App\Http\Controllers;

use App\Application\UseCase\HandleWebhook;
use Illuminate\Routing\Controller;

class TelegramController extends Controller
{
    private $handleRequest;

    public function __construct(HandleWebhook $handleRequest)
    {
        $this->handleRequest = $handleRequest;
    }

    public function handleRequest()
    {
        $this->handleRequest->perform();
    }
}
