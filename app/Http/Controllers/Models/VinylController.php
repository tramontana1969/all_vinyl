<?php

namespace App\Http\Controllers\Models;

use App\Http\Controllers\Controller;
use App\Models\Vinyl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VinylController extends Controller
{

    protected function search($query){
        return DB::table('vinyls')
            ->where('name', 'like', "%{$query}%")
            ->orWhere('author', 'like', "%{$query}%")
            ->get();
    }

    public function store(Request $request) {
        $query = $request->input('query');
        $vinyls = $this->search($query);
        if (count($vinyls) > 0) {
            return view('home', ['vinyls' => $vinyls]);
        }
        return redirect('/');
    }

    public function one($id) {
        $vinyl = Vinyl::findOrFail($id);
        return view('one_vinyl', ['vinyl' => $vinyl]);
    }
}
