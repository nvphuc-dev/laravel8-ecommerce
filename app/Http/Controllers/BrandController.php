<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Multipic;
use Illuminate\Support\Carbon;
use Image;
use Auth;

class BrandController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}

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
		// Notification
        $notification = array(
            'message' => 'Brand Inserted Successfully.',
            'alert-type' => 'info'
        );
		return Redirect()->back()->with($notification);
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
				'updated_at' => Carbon::now(),
			]);
			// Notification
			$notification = array(
				'message' => 'Brand Updated Successfully.',
				'alert-type' => 'success'
			);
			return Redirect()->back()->with($notification);
		} else {
			Brand::find($id)->update([
				'brand_name' => $request->brand_name,
				'updated_at' => Carbon::now(),
			]);
			// Notification
			$notification = array(
				'message' => 'Brand Updated Successfully.',
				'alert-type' => 'warning'
			);
			return Redirect()->back()->with($notification);
		}
		
	}

	public function Delete($id){
		// Remove image on disk
		$image = Brand::find($id);
		$old_image = $image->brand_image;
		unlink($old_image);

		Brand::find($id)->delete();
		// Notification
		$notification = array(
			'message' => 'Brand Deleted Successfully.',
			'alert-type' => 'error'
		);
		return Redirect()->back()->with($notification);
	}

	// This is for Multi Image All Methods
	public function Multpic(){
		$images = Multipic::all();

		return view('admin.multipic.index', compact('images'));
	}

	public function StoreImg(Request $request){
		$validatedData = $request->validate([
			'image' => 'required',
			'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
		]);

		$image = $request->file('image');

		foreach($image as $multi_img){
			// Use Intervention Image
			$name_gen = hexdec(uniqid()).'.'.$multi_img->getClientOriginalExtension();
			Image::make($multi_img)->resize(300, 300)->save('images/multi/'.$name_gen);

			$last_img = 'images/multi/'.$name_gen;

			Multipic::insert([
				'image' => $last_img,
				'created_at' => Carbon::now(),
			]);
		}
		// Notification
		$notification = array(
			'message' => 'Multi Image Inserted Successfully.',
			'alert-type' => 'info'
		);
		return Redirect()->back()->with($notification);
	}

	public function Logout(){
		Auth::logout();
		return Redirect()->route('login')->with('success', 'User Logout');
	}
}
