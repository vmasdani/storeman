<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TenantController
{
    public function all()
    {
        return new Response(Tenant::all());
    }
    public function get(int $id)
    {
        return new Response(Tenant::query()->find($id));
    }

    public function save(Request $r)
    {
        $body = json_decode($r->getContent());
        return new Response(
            Tenant::query()->updateOrCreate(
                [
                    'id' => isset($body->id) ? $body->id : null
                ],
                (array) $body
            )
        );
    }

}