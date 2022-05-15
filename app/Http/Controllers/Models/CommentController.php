<?php

namespace App\Http\Controllers\Models;

use App\Http\Controllers\Controller;
use App\Http\DataTransferObjects\CommentDTO;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function create(Request $request, $vinyl_id){
        $comment = CommentDTO::createCommentObject($request, $vinyl_id);
        return redirect("/vinyl/$comment->vinyl_id");
    }

    public function delete(Request $request, $id) {
        $comment = Comment::findOrFail($id);
        CommentDTO::deleteCommentObject($request, $comment);
        return redirect("/vinyl/$comment->vinyl_id");

    }
}
