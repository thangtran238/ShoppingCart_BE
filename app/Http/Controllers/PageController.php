<?php

namespace App\Http\Controllers;

use App\Models\bill_detail;
use App\Models\comments;
use App\Models\Product;
use App\Models\products;
use App\Models\slide;
use App\Models\slides;
use App\Models\type_products;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;
class PageController extends Controller
{

    public function getIndex()
    {
        $slide = slides::all();
        //return view('page.trangchu',['slide'=>$slide]);						
        $new_product = products::where('new', 1)->paginate(8);
        $sanpham_khuyenmai = products::where('promotion_price', '<>', 0)->paginate(4);

        return view('page.trangchu', compact('slide', 'new_product', 'sanpham_khuyenmai'));
    }

    public function getDetail(Request $request)
    {
        $sanpham = products::where('id', $request->id)->first();
        $splienquan = products::where('id', '<>', $sanpham->id, 'and', 'id_type', '=', $sanpham->id_type)->paginate(3);
        $comments =    comments::where('id_product', $request->id)->get();
        return view('page.chitiet_sanpham', compact('sanpham', 'splienquan', 'comments'));
    }
    public function getLoaiSp($type)
    {
        $type_product = type_products::all(); //Show ra tên loại sản phẩm
        $sp_theoloai = products::where('id_type', $type)->get();
        $sp_khac = products::where('id_type', '<>', $type)->paginate(3);
        return view('page.loai_sanpham', compact('sp_theoloai', 'type_product', 'sp_khac'));
    }
    public function getIndexAdmin()
    {
        $product = products::all();
        return view('pageadmin.admin')->with(['products' => $product, 'sumSold' => count(bill_detail::all())]);
    }
    public function getAdminAdd()
    {
        return view('pageadmin.formAdd');
    }

    public function postAdminAdd(Request $request)
    {
        $product = new products();

        if ($request->hasFile('inputImage')) {
            $file = $request->file('inputImage');
            $fileName = $file->getClientOriginalName();
            $file->move('source/image/product', $fileName);
            $product->image = $fileName;
        }

        $product->name = $request->inputName;
        $product->description = $request->inputDescription;
        $product->unit_price = $request->inputPrice;
        $product->promotion_price = $request->inputPromotionPrice;
        $product->unit = $request->inputUnit;
        $product->new = $request->inputNew;
        $product->id_type = $request->inputType;
        $product->save();
        return $this->getIndexAdmin();
    }

    public function postAdminDelete($id)
    {
        $product = products::find($id);
        $product->delete();
        return $this->getIndexAdmin();
    }
    public function getAdminEdit($id)
    {
        $product = products::find($id);
        return view('pageadmin.formEdit')->with('product', $product);
    }


    public function postAdminEdit(Request $request)
    {
        $id = $request->editId;
        $product = products::find($id);

        if ($request->hasFile('editImage')) {
            $file = $request->file('editImage');
            $fileName = $file->getClientOriginalName();
            $file->move('source/image/product', $fileName);
            $product->image = $fileName;
        }

        $product->name = $request->editName;
        $product->description = $request->editDescription;
        $product->unit_price = $request->editPrice;
        $product->promotion_price = $request->editPromotionPrice;
        $product->unit = $request->editUnit;
        $product->new = $request->editNew;
        $product->id_type = $request->editType;
        $product->save();
        return $this->getIndexAdmin();
    }


      public function getAddToCart(Request $req, $id)																				
      {																				
        if (Session::has('user')) {																				
          if (Products::find($id)) {																				
            $product = Products::find($id);																				
            $oldCart = Session('cart') ? Session::get('cart') : null;																				
            $cart = new Cart($oldCart);																				
            $cart->add($product, $id);																				
            $req->session()->put('cart', $cart);																				
            return redirect()->back();																				
          } else {																				
            return '<script>alert("Không tìm thấy sản phẩm này.");window.location.assign("/");</script>';																				
          }																				
        } else {																				
          return '<script>alert("Vui lòng đăng nhập để sử dụng chức năng này.");window.location.assign("/login");</script>';																				
        }																				
      }																				
                                                                                                                                                            
    
    public function getDelItemCart($id){
        $oldCart = Session::has('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if(count($cart->items)>0){
        Session::put('cart',$cart);

        }
        else{
            Session::forget('cart');
        }
        return redirect()->back();
    }





}
