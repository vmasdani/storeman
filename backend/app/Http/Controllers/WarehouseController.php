<?php

namespace App\Http\Controllers;

use App\Http\Services\TransactionService;
use App\Models\Tenant;
use App\Models\Transaction;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WarehouseController
{
    public function all()
    {
        $all = Warehouse::all();

        return new Response($all);
    }
    public function save(Request $r)
    {
        $body = json_decode($r->getContent());
        return new Response(
            Warehouse::query()->updateOrCreate([
                'id' => isset($body->id) ? $body->id : null
            ], (array) $body)
        );
    }

}