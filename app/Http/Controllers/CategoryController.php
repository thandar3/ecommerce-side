<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //category list
    public function categoryList(){
        $categories = Category::when(request('key'),function($query){
            $query->where('name','like','%'.request('key').'%');
        })->get();
        return view('admin.category.categoryList',compact('categories'));
    }

    //category create
    public function categoryCreate(){
        return view('admin.category.create');
    }

    //created category
    public function createdCategory(Request $request){
        $this->categoryValidationCheck($request);
        $data = $this->createdCategoryList($request);
        Category::create($data);
        return back()->with(['createSuccess' => 'Your Category created']);
    }

    //delete category
    public function categoryDelete($id){
        Category::where('id',$id)->delete();
        return back()->with(['deleteSuccess' => 'Your category deleted']);
    }

    //category edit form
    public function edit($id){
        $categories = Category::where('id',$id)->first();
        return view('admin.category.edit',compact('categories'));
    }

    //category update
    public function update(Request $request){
       $admin_id = $request->admin_id;
       if (Auth::user()->id == $admin_id) {
        $this->categoryValidationCheck($request);
        $updatedData = $this->updateCategoryList($request);
        Category::where('id',$request->categories_id)->update($updatedData);
        return redirect()->route('category#list')->with(['updateSuccess' => 'Your category updated']);
       }else{
        return back();
       }
    }

    //update list
    private function updateCategoryList($request){
        return [
            'name' => $request->categories,
        ];
    }


    //category list store
    private function createdCategoryList($request){
        return [
            'admin_id' => $request->admin_id,
            'name' => $request->categories,
        ];
    }

    //category list validation
    private function categoryValidationCheck($request){
        Validator::make($request->all(),[
            'categories' => 'required',
        ])->validate();
    }
}
