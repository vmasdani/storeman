<?php
namespace App\Http\Services;

use App\Models\Item;
use App\Models\ItemPrice;

class ItemService
{
    public static function save($item)
    {
        /** @var Item $item */
        \DB::transaction(function () use ($item) {

            // Check lst item price
            if (isset($item->item_prices)) {
                /** @var ItemPrice $lst */
                $lst = end($item->item_prices);

                if ($lst && $lst?->price) {
                    $item->last_price = $lst?->price;
                }
            }


            /** @var Item $savedItem */
            $savedItem = Item::query()->updateOrCreate(
                ['id' => isset($item->id) ? $item->id : null],
                (array) $item
            );

            foreach ($item->item_prices as $p) {
                /** @var ItemPrice $p */
                $p->item_id = $savedItem->id;

                ItemPrice::query()->updateOrCreate(
                    ['id' => isset($p->id) ? $p->id : null],
                    (array) $p
                );
            }
        });

    }
}