<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'parent_id',
        'user_id',
        'vinyl_id',
        'text',
        'date',
    ];
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function vinyl(){
        return $this->belongsTo('App\Models\Vinyl');
    }
}
