<?php

namespace App\Http\Controllers;

use App\Http\Services\ItemService;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ItemController
{
    public function all(Request $r)
    {
        $items = [];

        if ($r->query('all') == 'true') {
            $items = Item::all();
        } else {
            $items = Item::query()->where('tenant_id', '=', $r->attributes->get('id'))->get();
        }

        foreach ($items as $i) {
            $i->itemPrices;
        }

        return new Response($items);
    }
    public function save(Request $r)
    {

        /** @var Item $item */
        $item = json_decode($r->getContent());

        if ($r->attributes->get('id') && !isset($item->tenant_id)) {
            $item->tenant_id = $r->attributes->get('id');
        }

        ItemService::save($item);
    }
}