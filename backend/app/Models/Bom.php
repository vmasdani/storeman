<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Bom
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $type
 * @property int|null $item_id
 * @method static \Illuminate\Database\Eloquent\Builder|Bom newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bom newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bom query()
 * @method static \Illuminate\Database\Eloquent\Builder|Bom whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bom whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bom whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bom whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bom whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Bom extends Model {

}