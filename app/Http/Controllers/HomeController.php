<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Carbon;
use Image;
use Auth;

class HomeController extends Controller
{
	public function HomeSlider() {
		$sliders = Slider::latest()->get();
		return view('admin.slider.index', compact('sliders'));
	}

	public function AddSlider() {
		return view('admin.slider.create');
	}

	public function StoreSlider(Request $request) {
		// $validatedData = $request->validate([
		// 	'title' => 'required|unique:brands|min:4',
		// 	'description' => 'required|unique:brands|min:4',
		// 	'image' => 'required|mimes:jpg,jpeg,png,gif,svg',
		// ]);

		$slider_image = $request->file('image');

		$name_gen = hexdec(uniqid()).'.'.$slider_image->getClientOriginalExtension();
		Image::make($slider_image)->resize(1920, 1088)->save('images/slider/'.$name_gen);

		$last_img = 'images/slider/'.$name_gen;


		Slider::insert([
			'title' => $request->title,
			'description' => $request->description,
			'link' => $request->link,
			'text_button' => $request->text_button,
			'image' => $last_img,
			'created_at' => Carbon::now(),
		]);

		return Redirect()->route('home.slider')->with('success', 'Slider Inserted Successfully.');
	}

	public function Edit($id){
		$sliders = Slider::find($id);

		return view('admin.slider.edit', compact('sliders'));
	}

	public function Update(Request $request, $id){
		// $validatedData = $request->validate([
		// 	'title' => 'required|unique:brands|min:4',
		// 	'description' => 'required|unique:brands|min:4',
		// 	'image' => 'required|mimes:jpg,jpeg,png,gif,svg',
		// ]);

		// Check old image
		$old_image = $request->old_image;

		$slider_image = $request->file('image');

		if($slider_image){
			$name_gen = hexdec(uniqid());
			$img_ext = strtolower($slider_image->getClientOriginalExtension());
			$img_name = $name_gen.'.'.$img_ext;
			$up_location = 'images/slider/';
			$last_img = $up_location.$img_name;
			$slider_image->move($up_location, $img_name);
	
			// Remove old image
			unlink($old_image);
	
			Slider::find($id)->update([
				'title' => $request->title,
				'description' => $request->description,
				'link' => $request->link,
				'text_button' => $request->text_button,
				'image' => $last_img,
				'updated_at' => Carbon::now(),
			]);
	
			return Redirect()->back()->with('success', 'Slider Updated Successfully.');
		} else {
			Slider::find($id)->update([
				'title' => $request->title,
				'description' => $request->description,
				'link' => $request->link,
				'text_button' => $request->text_button,
				'updated_at' => Carbon::now(),
			]);

			return Redirect()->back()->with('success', 'Slider Updated Successfully.');
		}
	}

	public function Delete($id){
		// Remove image on disk
		$image = Slider::find($id);
		$old_image = $image->image;
		unlink($old_image);

		Slider::find($id)->delete();

		return Redirect()->back()->with('success', 'Slider Deleted Successfully.');
	}
}
