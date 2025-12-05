<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // Collects all categories
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    // Stores new category
    public function store(Request $request)

{

$request->validate([
    'name' => 'required|string|max:255'
]);

$category = Category::create($request->all());
return response()->json($category, 201);
}

public function update(Request $request, $id)
{
    $category = Category::findOrFail($id);
    $category->update($request->all());
    return response()->json($category);
}

public function destroy($id)
{
    $category = Category::findOrFail($id);
    $category->delete();
    return response()->json(['message' => 'Category has been deleted']);
}

}
