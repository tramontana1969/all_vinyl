<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

trait Search {
    public $table;
    public $columns;
    public $query;
    public function find(){
        $model = DB::table($this->table)->where($this->columns[0], 'like', "%{$this->query}%");
        for ($i = 0; $i < count($this->columns); $i++) {
            $model  ->orWhere($this->columns[$i], 'like', "%{$this->query}%");
        }
        return $model->get();
    }
}
