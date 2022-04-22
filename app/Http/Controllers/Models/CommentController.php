<?php

namespace App\Http\Controllers\Models;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public static function create(Request $request){
        if ($request->isMethod('post')) {
            $data = $request->validate([
                'parent_id' => 'nullable',
                'user_id' => 'required',
                'vinyl_id' => 'required',
                'text' => 'required',
                'date' => 'required',
            ]);
            $data['user_id'] = Auth::user()->id;
            $comment = new Comment($data);
            $comment->save();
            return redirect("vinyl/$comment->vinyl_id");
        };
    }
}
