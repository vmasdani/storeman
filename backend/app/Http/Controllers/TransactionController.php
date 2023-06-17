<?php

namespace App\Http\Controllers;

use App\Http\Services\TransactionService;
use App\Models\Tenant;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TransactionController
{
    public function all()
    {
        $all = Transaction::all();

        foreach ($all as $t) {
            $t->transactionItems;
        }
        return new Response($all);
    }
    public function save(Request $r)
    {
        $body = json_decode($r->getContent());
        return new Response(
            TransactionService::saveTransaction($body)
        );
    }

}