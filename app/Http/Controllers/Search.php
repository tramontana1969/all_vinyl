<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

trait Search {
    public $table;
    public $columns;
    public $query;
    public function find(){
        $model = DB::table($this->table);
        for ($i = 0; $i < count($this->columns); $i++) {
            $model  ->orWhere($this->columns[$i], 'like', "%{$this->query}%");
        }
        return $model->get();
    }
}
