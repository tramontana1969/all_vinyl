<?php

namespace App\Http\Controllers;

use App\Models\Vinyl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller {
    public function search(Request $request){
        if ($request->isMethod('post') && isset($_POST['query'])){
            $query = $_POST['query'];
            try {
                $vinyls = DB::table('vinyls')->where('name', 'like', "%{$query}%")->get();
            }
            catch (\Exception $e) {

                return redirect()->refresh();
            }
        }
        return view('results', ['vinyls' => $vinyls]);
    }
}
