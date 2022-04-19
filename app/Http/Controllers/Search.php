<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class Search {
    static function find($query, $columns){
        return DB::table('vinyls')
            ->where($columns[0], 'like', "%{$query}%")
            ->orWhere($columns[1], 'like', "%{$query}%")
            ->get();
    }
}
