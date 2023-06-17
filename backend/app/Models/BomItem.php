<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BomItem
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $item_id
 * @property float|null $qty
 * @method static \Illuminate\Database\Eloquent\Builder|BomItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BomItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BomItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|BomItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BomItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BomItem whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BomItem whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BomItem whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BomItem extends Model {

}