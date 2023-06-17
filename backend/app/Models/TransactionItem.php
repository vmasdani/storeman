<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TransactionItem
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $transaction_id
 * @property int|null $item_id
 * @property float|null $qty
 * @property int|null $warehouse_id
 * @property int|null $transaction_type
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionItem whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionItem whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionItem whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionItem whereTransactionType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionItem whereWarehouseId($value)
 * @mixin \Eloquent
 */
class TransactionItem extends Model
{
    protected $fillable = ['id', 'transaction_id', 'item_id', 'qty', 'warehouse_id', 'transaction_type'];

}