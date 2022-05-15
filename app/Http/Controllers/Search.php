<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

trait Search {
    public static $table;
    public static $columns;
    public static $query;
    public function find(){
        $model = DB::table(self::$table);
        for ($i = 0; $i < count(self::$columns); $i++) {
            $model  ->orWhere(self::$columns[$i], 'like', '%'.self::$query.'%');
        }
        return $model->get();
    }
}
