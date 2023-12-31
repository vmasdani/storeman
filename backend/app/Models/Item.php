<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Item
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $name
 * @property float|null $last_price
 * @method static \Illuminate\Database\Eloquent\Builder|Item newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Item newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Item query()
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereLastPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereUpdatedAt($value)
 * @property int|null $tenant_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ItemPrice> $itemPrices
 * @property-read int|null $item_prices_count
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereTenantId($value)
 * @mixin \Eloquent
 */
class Item extends Model
{
    protected $fillable = ['id', 'name', 'last_price', 'tenant_id', 'last_price'];
    public function itemPrices()
    {
        return $this->hasMany(ItemPrice::class);
    }
}