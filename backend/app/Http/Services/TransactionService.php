<?php
namespace App\Http\Services;


use App\Models\Transaction;
use App\Models\TransactionItem;

class TransactionService
{
    public static function saveTransaction( $t)
    {
        /** @var ?Transaction $savedTransaction */
        $savedTransaction = Transaction::query()->updateOrCreate(
            ['id' => isset($t->id) ? $t->id : null],
            (array) $t
        );

        foreach ($t->transactionItems as $i) {
            /** @var TransactionItem $i */
            $i->transaction_id = $savedTransaction?->id;

            TransactionItem::query()->updateOrCreate(
                ['id' => isset($i->id) ? $i->id : null],
                (array) $i
            );
        }

        return $savedTransaction;
    }
}