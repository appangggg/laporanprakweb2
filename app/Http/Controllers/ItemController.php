<?php
namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        return response()->json(Item::with('category')->get(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string',
            'qty' => 'required|integer|min:0',
            'price' => 'required|integer|min:0',
        ]);

        $item = Item::create($validated);
        return response()->json(['message' => 'Success', 'data' => $item], 201);
    }

    public function show($id)
    {
        $item = Item::with('category')->find($id);
        if (!$item) return response()->json(['message' => 'Not found'], 404);
        return response()->json($item, 200);
    }

    public function update(Request $request, $id)
    {
        $item = Item::find($id);
        if (!$item) return response()->json(['message' => 'Not found'], 404);

        $item->update($request->all());
        return response()->json(['message' => 'Updated', 'data' => $item], 200);
    }

    public function destroy($id)
    {
        $item = Item::find($id);
        if (!$item) return response()->json(['message' => 'Not found'], 404);

        $item->delete();
        return response()->json(['message' => 'Deleted'], 200);
    }
}