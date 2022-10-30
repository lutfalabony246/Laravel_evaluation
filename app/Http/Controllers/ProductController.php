<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Product;
use App\Models\Subcategories;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // product wise filter
    // category filter
    public function ProductFilter($prouct_id)
    {
         $product=Product::where('id',$prouct_id)->with('subcategory')->get();

         return response()->json([
            'product'=>$product
        ]);

    }
    // category filter
    public function CatFilter($cat_id)
    {
         $cat_product=Categories::where('id',$cat_id)->with('product.subcategory')->get();

         return response()->json([
            'cat_product'=>$cat_product
        ]);

    }
    // subcategory filter
    public function SubcatFilter($sub_cat_id)
    {
         $sub_product=Product::where('subcategory_id',$sub_cat_id)->with('subcategory')->get();
         return response()->json([
            'sub_product'=>$sub_product
        ]);

    }
// product view
    public function View()
    {
        $categories=Categories::get();
        $subcategories=Subcategories::get();
        $products=Product::with('subcategory')->get();
        return view('product.product_view',compact('products','subcategories','categories'));
    }


    //////////////////////////// product add/////////////////////////////////
    public function Create()
    {

        return view('product.product_add',compact('subcategories'));
    }
    //product store
    public function Store(Request $request)
    {

      //for validating requested data
      $validator = Validator::make($request->all(), [
            'subcategory_id' => 'required',
            'thumbnail' => 'required',
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
        ],
        [
            'subcategory_id.required' => 'sub category name is required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        }
        else
        {

            try {

                $image = $request->file('thumbnail');
                $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(400, 400)->save('upload/products/' . $name_gen);
                $save_url = 'upload/products/' . $name_gen;

               // storing in database
            Product::create([
                'title' => $request->title,
                'subcategory_id' => $request->subcategory_id,
                'description' => $request->description,
                'price' => $request->price,
                'thumbnail' => $save_url,

                ]);

                return response()->json(['message' => 'product Added Successfully']);
                } catch (\Exception $e) {
                return ('Insert into database error -' . $e->getLine() . $e->getMessage());
                }
        }


    }
    // delete product
    public function Delete($id)
    {
      Product::find($id)->delete();
      return back();
    }


}
