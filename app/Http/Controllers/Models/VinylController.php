<?php

namespace App\Http\Controllers\Models;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Search;
use App\Models\Vinyl;
use Illuminate\Http\Request;

class VinylController extends Controller
{
    use Search;

    public function store(Request $request) {
        Search::$query = $request->input('query');
        Search::$columns = ['name', 'author'];
        Search::$table = 'vinyls';
        $sort = $request->input('sort-by');
        $vinyls = Search::find();
        if (count($vinyls) > 0) {
            switch ($sort){
                case null:
                    break;
                case 'name':
                    $vinyls=$vinyls->sortBy('name');
                    break;
                case 'price':
                    $vinyls=$vinyls->sortBy('price');
                    break;
            }
            return view('home', ['vinyls' => $vinyls]);
        }
        return redirect('/');
    }

    public function one($id) {
        $vinyl = Vinyl::findOrFail($id);
        return view('one_vinyl', ['vinyl' => $vinyl,]);
    }
}
