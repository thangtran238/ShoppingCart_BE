<?php

namespace App\Http\Controllers;

use App\Models\productLazada;
use Illuminate\Http\Request;

class LazadaController extends Controller
{
    public function getProductLazada()
{
    $lazada_products = productLazada::all();						
    return response()->json($lazada_products);		    
}
					
public function addProductLazada(Request $request)						
{						
    $productLazada = new productLazada();						
    $productLazada->Name = $request->input('Name');						
    $productLazada->Image = $request->input('Image');	
    $productLazada->Price = intval($request->input('Price'));						
    $productLazada->Shop = $request->input('Shop');
    $productLazada->save();			
    
    return  response()->json($productLazada);						
}

public function editProductlazada(Request $request, $id)
    {
        $productLazada =productLazada::find($id);

        $productLazada->Name = $request->input('Name');						
        $productLazada->Image = $request->input('Image');	
        $productLazada->Price = intval($request->input('Price'));						
        $productLazada->Shop = $request->input('Shop');
        $productLazada->save();	
        return response()->json(['status' => 'ok', 'msg' => 'Edit successed']);
    }

    public function uploadImage(Request $request)
    {
        // process image										
        if ($request->hasFile('uploadImage')) {
            $file = $request->file('uploadImage');
            $fileName = $file->getClientOriginalName();

            $file->move('source/image/productlazada', $fileName);

            return response()->json(["message" => "ok"]);
        } else return response()->json(["message" => "false"]);
    }

    // public function deleteProductLazada($id)
    // {
    //     $product = productLazada::find($id);
    //     $fileName = 'source/image/productLazada/' . $product->image;
    //     if (File::exists($fileName)) {
    //         File::delete($fileName);
    //     }
    //     $product->delete();
    //     return ['status' => 'ok', 'msg' => 'Delete successed'];
    // }

}
