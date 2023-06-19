<?php

namespace App\Http\Controllers;

use App\Http\Services\TransactionService;
use App\Models\Tenant;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TransactionController
{
    public function all(Request $r)
    {
        $transactions = Transaction::all();

        if ($r->query('all') == 'true') {
            $transactions = Transaction::all();
        } else {
            $transactions = Transaction::query()->where('tenant_id', '=', $r->attributes->get('id'))->get();
        }

        foreach ($transactions as $t) {
            $t->transactionItems;
        }
        return new Response($transactions);
    }
    public function save(Request $r)
    {
        /** @var Transaction $transaction */
        $transaction = json_decode($r->getContent());

        if ($r->attributes->get('id') && !isset($transaction->tenant_id)) {
            $transaction->tenant_id = $r->attributes->get('id');
        }


        return new Response(
            TransactionService::saveTransaction($transaction)
        );
    }

}