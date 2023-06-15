<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(title="Test API",version="3.0.0",description="API for test"),
 * @OA\Get(
 *     path="/api",
 *     @OA\Response(response="200", description="An example endpoint")
 * )
 *
 */

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
