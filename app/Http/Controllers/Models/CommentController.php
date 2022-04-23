<?php

namespace App\Http\Controllers\Models;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function create(Request $request, $vinyl_id){
        if ($request->isMethod('post')) {
            $data = $request->validate([
                'text' => 'required',
            ]);
            $data['user_id'] = Auth::user()->id;
            $data['vinyl_id'] = $vinyl_id;
            $data['date'] = date('y-m-d');
        };
        $comment = new Comment($data);
        $comment->save();
        return redirect("/vinyl/$comment->vinyl_id");
    }

    public function delete(Request $request, $id) {
        $comment = Comment::findOrFail($id);
        if($request->isMethod('delete')) {
            if($comment->user_id == Auth::user()->id || Auth::user()->hasRole('admin')) {
                $vinyl_id = $comment->vinyl_id;
                $comment->delete();
                return redirect("/vinyl/$vinyl_id");
            }
        }
    }
}
