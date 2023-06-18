<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ItemPrice
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $item_id
 * @property float|null $price
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPrice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPrice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPrice query()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPrice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPrice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPrice whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPrice wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPrice whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ItemPrice extends Model
{
    protected $fillable = ['id', 'item_id', 'price'];
}