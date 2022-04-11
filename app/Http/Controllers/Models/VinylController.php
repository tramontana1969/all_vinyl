<?php

namespace App\Http\Controllers\Models;

use App\Http\Controllers\Controller;
use App\Models\Vinyl;

class VinylController extends Controller
{
    public function all() {
        $vinyls = Vinyl::all();
        return view('home', ['vinyls' => $vinyls]);
    }

    public function one($id) {
        $vinyl = Vinyl::findOrFail($id);
        return view('one_vinyl', ['vinyl' => $vinyl]);
    }
}
