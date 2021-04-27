<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeAbout;
use App\Models\Multipic;
use Illuminate\Support\Carbon;

class AboutController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function HomeAbout() {
        $homeabout = HomeAbout::latest()->get();
        return view('admin.home.index', compact('homeabout'));
    }

    public function AddAbout() {
        return view('admin.home.create');
    }

    public function StoreAbout(Request $request) {
        HomeAbout::insert([
            'big_title' => $request->big_title,
            'title' => $request->title,
            'short_discription' => $request->short_discription,
            'long_discription' => $request->long_discription,
            'created_at' => Carbon::now(),
        ]);

        return Redirect()->route('home.about')->with('success', 'About Inserted Successfully.');
    }

    public function EditAbout($id) {
        $homeabout = HomeAbout::find($id);
        return view('admin.home.edit', compact('homeabout'));
    }

    public function UpdateAbout(Request $request, $id) {
        $update = HomeAbout::find($id)->update([
            'big_title' => $request->big_title,
            'title' => $request->title,
            'short_discription' => $request->short_discription,
            'long_discription' => $request->long_discription,
            'updated_at' => Carbon::now(),
        ]);

        return Redirect()->route('home.about')->with('success', 'About Updated Successfully.');
    }

    public function DeleteAbout($id) {
        $delete = HomeAbout::find($id)->delete();
        return Redirect()->back()->with('success', 'About Deleted Successfully.');
    }

    public function Portfolio() {
        $images = Multipic::all();
        return view('pages.portfolio', compact('images'));
    }
}
