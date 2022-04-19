<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller {
    public function search(Request $request){
        if ($request->isMethod('post') && isset($_POST['query'])){
            $query = $_POST['query'];
                $vinyls = DB::table('vinyls')
                    ->where('name', 'like', "%{$query}%")
                    ->orWhere('author', 'like', "%{$query}%")
                    ->get();
        }
        return view('results', ['vinyls' => $vinyls]);
    }
}
