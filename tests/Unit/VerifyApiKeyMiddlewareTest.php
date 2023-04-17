<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Middleware\VerifyApiKey;

class VerifyApiKeyMiddlewareTest extends TestCase
{
    /**
     * Test authorized
     */
    public function test_authorized(): void
    {
        $request = Request::create('/', 'POST', [], [], [], ['HTTP_API-KEY' => 'qwerty']);

        $middleware = new VerifyApiKey();

        $response = $middleware->handle($request, function () {
            return new Response();
        });

        $this->assertEquals($response->getStatusCode(), 200);
    }

    /**
     * Test unauthorized
     */
    public function test_unauthorized(): void
    {
        $request = Request::create('/');

        $middleware = new VerifyApiKey();

        $response = $middleware->handle($request, function () {
            return new Response();
        });

        $this->assertEquals($response->getStatusCode(), 401);
    }
}
