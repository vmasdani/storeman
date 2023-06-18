<?php
namespace App\Http\Controllers;

use App\Http\Services\AuthService;
use App\Models\Tenant;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController
{
    public function getSecret()
    {
        return AuthService::getSecretKey();
    }
    public function getJwtByEmail(Request $r)
    {
        /** @var Tenant $t */
        $t = Tenant::query()->where('email', '=', $r->query('email'))->first();

        if (!$t) {
            return new Response(content: 'Tenant not found.', status: 404);
        }

        return JWT::encode(
            [
                'jti' => $t->id,
                'nbf' => time(),
                // 1 yr expiration
                'exp' => time() + (86400 * 365),

            ],
            AuthService::getSecretKey(),
            'HS256'
        );
    }

}