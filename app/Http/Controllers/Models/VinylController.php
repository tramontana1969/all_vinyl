<?php

namespace App\Http\Controllers\Models;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Search;
use App\Models\Comment;
use App\Models\Vinyl;
use Illuminate\Http\Request;

class VinylController extends Controller
{
    public function store(Request $request) {
        $query = $request->input('query');
        $vinyls = Search::find($query, ['name', 'author']);
        if (count($vinyls) > 0) {
            return view('home', ['vinyls' => $vinyls]);
        }
        return redirect('/');
    }

    public function one($id) {
        $vinyl = Vinyl::findOrFail($id);
        return view('one_vinyl', ['vinyl' => $vinyl,]);
    }
}
