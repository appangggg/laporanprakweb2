<?php

namespace App\Services;

use App\Models\Item;
use Illuminate\Database\Eloquent\Collection;

/**
 * Author: Muh. Asyfar Arifin Liwan
 * NIM: 60200124013
 */
class ItemService {
    public function all(): Collection {
        return Item::with('category')->get();
    }

    public function find(int $id): Item {
        return Item::with('category')->findOrFail($id);
    }

    public function create(array $data): Item {
        return Item::create($data);
    }

    public function update(int $id, array $data): Item {
        $item = Item::findOrFail($id);
        $item->update($data);
        return $item;
    }

    public function delete(int $id): void {
        Item::destroy($id);
    }
}