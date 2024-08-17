<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    // product list page
    public function list(){


        $products = Product::when(request('searchKey'),function($query){
            $query->whereAny(['name', 'price','count'],'like','%'.request('searchKey').'%');
        })

                    ->paginate(3);
        return view('admin.product.list',compact('products'));
    }

    // show product create page
    public function createPage(){
        $categories = Category::get();
        return view('admin.product.create',compact('categories'));
    }
    // product create
    public function create(Request $request){
        $this->formValidation($request,'create');
        $data = $this->requestFormData($request);
        if($request->hasFile('image')){
            $fileName= uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path(). '/productImages/',$fileName);
            $data['image']= $fileName;
        }
        Product::create($data);
        Alert::success('Success ', 'Product Create Successfully...');
        return redirect()->route('productList');
    }

    // delete products
    public function delete($id){
        Product::where('id',$id)->delete();
        Alert::success('Success ', 'Product Delete Successfully...');
        return back();
    }

    // product deatails
    public function details($id){
        $product = Product::select('products.id', 'products.name', 'products.price', 'products.description','products.category_id', 'products.count','products.image','categories.name as category_name')
                            ->leftJoin('categories','products.category_id','categories.id')
                            ->where('products.id',$id)->first();

        return view('admin.product.details',compact('product'));
    }

    // edit page
    public function edit($id){
        $product = Product::select('products.id', 'products.name', 'products.price', 'products.description','products.category_id', 'products.count','products.image','categories.name as category_name')
        ->leftJoin('categories','products.category_id','categories.id')
        ->where('products.id',$id)->first();

        $categories = Category::get();
        return view('admin.product.edit',compact('product','categories'));
    }
// product edit
    public function update(Request $request){
        $this->formValidation($request,'update');
        $data= $this->requestFormData($request);

        if($request->hasFile('image')){
            //delete old image
            $oldImage = $request->oldImage;
            if(file_exists(public_path('productImages/'.$oldImage))){
                unlink(public_path('productImages/'.$oldImage));
            }
            //upload new image
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path(). '/productImages/',$fileName);
            $data['image']= $fileName;
        }else{
            $data['image'] = $request->oldImage;
        }
        Product::where('id',$request->productId)->update($data);
        Alert::success('Success ', 'Product Update Successfully...');
        return to_route('productList');
    }

// form validation
    private function formValidation($request, $action){
        $validationRules = [
            'name' => 'required|unique:products,name,'.$request->productId,
            'price' => 'required|numeric',
            'description' => 'required',
            'categoryId' => 'required',
            'count' => 'required|numeric|min:1|max:100',

        ];
        $validationRules['image'] = $action == "create" ? 'required|mimes:jpg,jpeg,png,webp|file': 'mimes:jpg,jpeg,png,webp|file';
        // you can make custom message
        $validationMessage =[
            'name.required' => 'ဖြည့် စွက်ရန်လိုအပ်ပါသည်။',

        ];
        $validatior = $request->validate($validationRules,$validationMessage);
    }

    // request form data
    private function requestFormData($request){
        return [
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $request->categoryId,
            'count' => $request->count
        ];
    }
}
