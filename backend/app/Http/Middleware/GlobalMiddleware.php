<?php
namespace App\Http\Middleware;

use App\Http\Services\AuthService;
use App\Models\Tenant;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GlobalMiddleware
{
    public function handle(Request $request, \Closure $next): Response
    {

        // Pass jwt
        $auth = $request->header('Authorization');
        $request->attributes->add(['token' => $auth]);

        if ($auth) {
            $secret = AuthService::getSecretKey();
            $decoded = JWT::decode($auth, new Key($secret, 'HS256'));

            if ($decoded->jti) {
                $request->attributes->add(['id' => $decoded->jti]);
                $request->attributes->add([
                    'tenant' => Tenant::query()->find($decoded->jti)->first()->toArray()
                ]);

            }
        }

        $response = $next($request);

        // Perform action

        return $response;
    }
}