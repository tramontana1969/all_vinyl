<?php

namespace App\Http\Controllers\Models;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Search;
use App\Http\DataTransferObjects\VinylDTO;
use App\Models\Vinyl;
use Illuminate\Http\Request;

class VinylController extends Controller
{
    use Search;

    public function store(Request $request) {
        $vinyls = VinylDTO::vinylRequest($request);
        return view('home', ['vinyls' => $vinyls]);
    }

    public function one($id) {
        $model = Vinyl::findOrFail($id);
        $vinyl = VinylDTO::singleVinyl($model);
        return view('one_vinyl', ['vinyl' => $vinyl]);
    }
}
