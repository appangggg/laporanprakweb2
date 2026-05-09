<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json(Category::all(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category = Category::create($validated);
        return response()->json(['message' => 'Success', 'data' => $category], 201);
    }

    public function show($id)
    {
        $category = Category::with('items')->find($id);
        if (!$category) return response()->json(['message' => 'Not found'], 404);
        return response()->json($category, 200);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if (!$category) return response()->json(['message' => 'Not found'], 404);

        $category->update($request->all());
        return response()->json(['message' => 'Updated', 'data' => $category], 200);
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if (!$category) return response()->json(['message' => 'Not found'], 404);

        $category->delete();
        return response()->json(['message' => 'Deleted'], 200);
    }
}