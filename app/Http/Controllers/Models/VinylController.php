<?php

namespace App\Http\Controllers\Models;

use App\Http\Controllers\Controller;
use App\Models\Vinyl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class VinylController extends Controller
{
    public function all() {
        $vinyls = Vinyl::all();
        return view('home', ['vinyls' => $vinyls]);
    }

    public function add(Request $request){
        if ($request->isMethod('post')){
            $data = $request -> validate(
                [
                    'author' => 'required|max:64',
                    'name' => 'required|max:64',
                    'cover' => 'required',
                    'price' => 'required',
                    'year' => 'required',
                    'description' => 'required',
                ]
            );
        }
        $filename = $data['cover']->getClientOriginalName();
        $data['cover']->move(Storage::path('public/vinyls/covers/').'origin/', $filename);
        $thumbnail = Image::make(Storage::path('public/vinyls/covers/').'origin/'.$filename);
        $thumbnail->fit(300, 300);
        $thumbnail->save(Storage::path('public/vinyls/covers/').'thumbnail/'.$filename);
        $data['cover'] = $filename;
        $vinyl = new Vinyl($data);
        $vinyl->save();
        return redirect()->refresh();
    }
}
