<?php


namespace App\Http\Controllers;


use App\Models\ProductsCategory;
use Illuminate\Http\Request;

class ProductsCategoryController extends Controller
{

    public function index(Request $request)
    {
        $categories = ProductsCategory::all()->where('user_id', $request->userRequest->id);
        return response()->json($categories);
    }

    public function store(Request $request)
    {

        $category = ProductsCategory::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'user_id' => intval($request->userRequest->id)
        ]);

        return response()->json($category,201);
    }

    public function show(Request $request,int $id)
    {
        $category = ProductsCategory::all()->where('id',$id)->where('user_id', $request->userRequest->id)->first();

        if(! $category){
            return response()->json(['error'=> 'Você não tem categoria nesse id'], 404);
        }

        return response()->json($category);
    }

    public function update(Request $request, int $id)
    {

        $category = ProductsCategory::all()->where('id', $id)->where('user_id', $request->userRequest->id)->first();

        if(! $category){
            return response()->json(["error"=>'Você não tem categoria nesse id'],404);
        }

        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->user_id = intval($request->userRequest->id);

        $category->save();

        return response()->json($category);

    }

    public function destroy(Request $request, int $id)
    {
        $category = ProductsCategory::all()->where('id', $id)->where('user_id', $request->userRequest->id)->first();

        if(!$category){
            return response()->json(["error"=>'Você não tem categoria nesse id'],404);
        }

        $category->delete();

        return response()->json(["message"=>"Categoria removida"]);
    }

}
