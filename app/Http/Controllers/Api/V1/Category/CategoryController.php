<?php

namespace App\Http\Controllers\Api\V1\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::all();
        return response()->json([
            'status'=> 'successfully',
            'category'=> $category
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->save();
        return response()->json([
            'status'=> 'create category successfully',
            'category'=> $category
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        if(!$category){
            return response()->json(['message '=> 'Not found category'], 404);
        }
        return response()->json([
            'status'=>' successfully',
            'category'=> new CategoryResource($category)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
        if(!$category){
            return response()->json(['message '=> 'Not found category'], 404);
        }
        $category->name =$request->name ?? $category->name;
        $category->save();
        return response()->json([
            'status'=> 'Update category successfully',
            'category'=> $category
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        if(!$category){
            return response()->json(['message '=> 'Not found category'], 404);
        }
        $category->delete();
        return response()->json([
            'status'=>' delete category successfully',
        ]);
    }
}
