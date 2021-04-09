<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Multipic;
use Illuminate\Support\Carbon;
use Image;

class BrandController extends Controller
{
    public function AllBrand(){
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index', compact('brands'));
    }

    public function StoreBrand(Request $request){
        $validatedData = $request->validate([
            'brand_name' => 'required|unique:brands|min:4',
            'brand_image' => 'required|mimes:jpg,jpeg,png,gif,svg',
        ],
        [
            'brand_name.required' => 'Please Input Brand Name',
            'brand_name.min' => 'Brand longer then 4 characters',
        ]);

        $brand_image = $request->file('brand_image');

        // Use Basic upload image
        // $name_gen = hexdec(uniqid());
        // $img_ext = strtolower($brand_image->getClientOriginalExtension());
        // $img_name = $name_gen.'.'.$img_ext;
        // $up_location = 'images/brand/';
        // $last_img = $up_location.$img_name;
        // $brand_image->move($up_location, $img_name);

        // Use Intervention Image
        $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
        Image::make($brand_image)->resize(300, 200)->save('images/brand/'.$name_gen);

        $last_img = 'images/brand/'.$name_gen;


        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now(),
        ]);

        return Redirect()->back()->with('success', 'Brand Inserted Successfully.');
    }

    public function Edit($id){
        $brands = Brand::find($id);

        return view('admin.brand.edit', compact('brands'));
    }

    public function Update(Request $request, $id){
        $validatedData = $request->validate([
            'brand_name' => 'required|min:4',
        ],
        [
            'brand_name.required' => 'Please Input Brand Name',
            'brand_name.min' => 'Brand longer then 4 characters',
        ]);

        // Check old image
        $old_image = $request->old_image;

        $brand_image = $request->file('brand_image');

        if($brand_image){
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($brand_image->getClientOriginalExtension());
            $img_name = $name_gen.'.'.$img_ext;
            $up_location = 'images/brand/';
            $last_img = $up_location.$img_name;
            $brand_image->move($up_location, $img_name);
    
            // Remove old image
            unlink($old_image);
    
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'brand_image' => $last_img,
                'created_at' => Carbon::now(),
            ]);
    
            return Redirect()->back()->with('success', 'Brand Updated Successfully.');
        } else {
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'created_at' => Carbon::now(),
            ]);

            return Redirect()->back()->with('success', 'Brand Updated Successfully.');
        }
        
    }

    public function Delete($id){
        // Remove image on disk
        $image = Brand::find($id);
        $old_image = $image->brand_image;
        unlink($old_image);

        Brand::find($id)->delete();

        return Redirect()->back()->with('success', 'Brand Deleted Successfully.');
    }

    // This is for Multi Image All Methods
    public function Multpic(){
        $images = Multipic::all();

        return view('admin.multipic.index', compact('images'));
    }

    public function StoreImg(Request $request){
        $image = $request->file('image');

        foreach($image as $multi_img){
            // Use Intervention Image
            $name_gen = hexdec(uniqid()).'.'.$multi_img->getClientOriginalExtension();
            Image::make($multi_img)->resize(300, 300)->save('images/multi/'.$name_gen);

            $last_img = 'images/multi/'.$name_gen;

            Brand::insert([
                'image' => $last_img,
                'created_at' => Carbon::now(),
            ]);
        }

        return Redirect()->back()->with('success', 'Multi Image Inserted Successfully.');
    }
}
