<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function AllCat(){
        //21. Eloquent ORM Read Data.mp4
        // $categories = Category::all(); // Hiển thị tất cả từ id tăng
        // $categories = Category::latest()->get(); // Hiển thị theo thứ tự created_at mới nhất
        $categories = Category::latest()->paginate(5);
        $trashCat = Category::onlyTrashed()->latest()->paginate(3);

        //22. Query Builder Read Data.mp4
        // $categories = DB::table('categories')->latest()->paginate(5);

        // Query Builder Join Table
        // $categories = DB::table('categories')->join('users', 'categories.user_id', 'users.id')->select('categories.*', 'users.name')->latest()->paginate(5);

        return view('admin.category.index', compact('categories', 'trashCat'));
    }

    public function AddCat(Request $request){
        $validatedData = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ],
        [
            'category_name.required' => 'Please Input Category Name',
            'category_name.max' => 'Category less then 255 chars',
        ]);

        // 1. Eloquent ORM Insert Data

        Category::insert([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);

        // $category = new Category;
        // $category->category_name = $request->category_name;
        // $category->user_id = Auth::user()->id;
        // $category->save();

        // 2. Insert Data With Query Builder

        // $data = array();
        // $data['category_name'] = $request->category_name;
        // $data['user_id'] = Auth::user()->id;
        // $data['created_at'] = Carbon::now();
        // DB::table('categories')->insert($data);

        return Redirect()->back()->with('success', 'Category Inserted Successfully.');
    }

    public function Edit($id) {
        // 1. Eloquent ORM Edit & Update
        // $categories = Category::find($id);

        // 2. Query Builder Edit & Update Data
        $categories = DB::table('categories')->where('id', $id)->first();

        return view('admin.category.edit', compact('categories'));
    }

    public function Update(Request $request, $id){
        // 1. Eloquent ORM Edit & Update
        // $update = Category::find($id)->update([
        //     'category_name' => $request->category_name,
        //     'user_id' => Auth::user()->id
        // ]);

        // 2. Query Builder Edit & Update Data
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        DB::table('categories')->where('id', $id)->update($data);

        return Redirect()->route('all.category')->with('success', 'Category Updated Successfully.');
    }

    public function SoftDelete($id){
        $delete = Category::find($id)->delete();

        return Redirect()->back()->with('success', 'Category Soft Deleted Successfully.');
    }

    public function Restore($id){
        $delete = Category::withTrashed()->find($id)->restore();

        return Redirect()->back()->with('success', 'Category Restored Successfully.');
    }

    public function Empty($id){
        $delete = Category::onlyTrashed()->find($id)->forceDelete();

        return Redirect()->back()->with('success', 'Category Emptied Successfully.');
    }
}
