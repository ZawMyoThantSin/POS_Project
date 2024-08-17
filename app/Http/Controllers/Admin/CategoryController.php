<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    //show category list
    public function list(){
        $data = Category::orderBy('created_at','asc')->paginate(5);
        return view('admin.category.list',compact('data'));
    }
    //show category create page
    public function createPage(){
        return view('admin.category.create');
    }
    // category create
    public function create(Request $request){
        $validator = $request->validate([
            'categoryName'=> 'required|unique:categories,name'
        ],[
            //you can make custome message here...
        ]);

        Category::create([
            'name' => $request->categoryName
        ]);
        Alert::success('Success ', 'Category Create Successfully...');
        return back();
    }

    //category delete
    public function delete($id){
        Category::where('id',$id)->delete();
        Alert::success('Success ', 'Category Delete Successfully...');
        return back();
    }

    //edit page
    public function edit($id){
        $data = Category::where('id',$id)->first();

        return view('admin.category.edit', compact('data'));
    }
    //categroy update
    public function update(Request $request){
        $validator = $request->validate([
            'categoryName' => 'required|unique:categories,name,'.$request->id
        ]);
        Category::where('id',$request->id)->update([
            'name' => $request->categoryName
        ]);

        Alert::success('Success ', 'Category Update Successfully...');
        return to_route('categoryList');
    }
}
