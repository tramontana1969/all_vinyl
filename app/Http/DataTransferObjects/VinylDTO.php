<?php
//
//namespace App\Http\DataTransferObjects;
//
//use App\Http\Controllers\Search;
//use Illuminate\Http\Request;
//use Spatie\DataTransferObject\DataTransferObject;
//
//final class VinylDTO extends DataTransferObject {
//
//    use Search;
//
//    public $id;
//    public $author;
//    public $name;
//    public $cover;
//    public $price;
//    public $year;
//    public $description;
//
//    public static function VinylRequest(Request $request) {
//        $query = $request->input('query');
//        $columns = ['name', 'author'];
//        $table = 'vinyls';
//        $sort = $request->input('sort-by');
//        $vinyls = $this->find();
//    }
//}
