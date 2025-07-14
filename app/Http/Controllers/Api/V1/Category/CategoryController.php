<?php 
namespace App\Http\Controllers\Api\V1\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {   
        $category = Category::all();
        return response()->json([
            'status' => 'success',
            'categories' => CategoryResource::collection($category)
        ]);
    }

    public function store(CategoryRequest $request)
    {
        $validated = $request->validated();

        $category = Category::create($validated);

        return response()->json([
            'status' => 'Category created successfully',
            'category' => new CategoryResource($category)
        ], 201);
    }

    public function show(string $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        return response()->json([
            'status' => 'success',
            'category' => new CategoryResource($category)
        ]);
    }

    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
        ]);

        $category->update($validated);

        return response()->json([
            'status' => 'Category updated successfully',
            'category' => new CategoryResource($category)
        ]);
    }

    public function destroy(string $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $category->delete();

        return response()->json([
            'status' => 'Category deleted successfully'
        ]);
    }
}
