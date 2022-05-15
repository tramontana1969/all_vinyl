<?php

namespace App\Http\DataTransferObjects;

use App\Http\Controllers\Search;
use App\Models\Vinyl;
use Illuminate\Http\Request;
use Spatie\DataTransferObject\DataTransferObject;

final class VinylDTO extends DataTransferObject {

    use Search;

    public static function vinylRequest(Request $request) {
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
            return $vinyls;
        }
        return redirect('/');
    }

    public static function singleVinyl(Vinyl $vinyl){
        return [
            'id' => $vinyl->id,
            'author' => $vinyl->author,
            'name' => $vinyl->name,
            'cover' => $vinyl->cover,
            'price' => $vinyl->price,
            'year' => $vinyl->year,
            'quantity' => $vinyl->quantity,
            'comment' => $vinyl->comment,
            'description' => $vinyl->description,
        ];
    }
}
