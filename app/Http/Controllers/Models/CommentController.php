<?php

namespace App\Http\Controllers\Models;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public static function create(Request $request, $vinyl_id){
        if ($request->isMethod('post')) {
            $data = $request->validate([
                'parent_id' => 'nullable',
                'text' => 'required',
            ]);
            $data['user_id'] = Auth::user()->id;
            $data['vinyl_id'] = $vinyl_id;
            $data['date'] = date('y-m-d');
        };
        $comment = new Comment($data);
        $comment->save();
        return redirect("vinyl/$comment->vinyl_id");
    }
}
