<?php


namespace App\Http\Controllers;


use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $products = Product::all()->where('user_id', $request->userRequest->id);
        return response()->json($products);
    }

    public function store(Request $request)
    {
        $product = Product::create([
            'name'=> $request->input('name'),
            'description'=> $request->input('description'),
            'price'=> $request->input('price'),
            'amount'=> $request->input('amount'),
            'category_id'=> $request->input('category_id'),
            'user_id'=> intval($request->userRequest->id),
        ]);

        return response()->json($product,201);
    }

    public function show(Request $request,int $id)
    {
        $product = Product::all()->where('id',$id)->where('user_id', $request->userRequest->id)->first();
        if(! $product){
            return response()->json(["error"=>"Você não tem produto nesse id"],404);
        }

        return response()->json($product);
    }

    public function update(Request $request, int $id)
    {
        $product = Product::all()->where('id',$id)->where('user_id', $request->userRequest->id)->first();
        if(! $product){
            return response()->json(["error"=>"Você não tem produto nesse id"],404);
        }

        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->amount = $request->input('amount');
        $product->category_id = $request->input('category_id');
        $product->user_id = intval($request->userRequest->id);

        $product->save();
        return response()->json($product);
    }

    public function destroy(Request $request, int $id)
    {
        $product = Product::all()->where('id', $id)->where('user_id', $request->userRequest->id)->first();

        if(!$product){
            return response()->json(["error"=>"Você não tem produto nesse id"],404);
        }

        $product->delete();

        return response()->json(["message"=>"Produto removido"]);
    }

}
