<?php

namespace App\Http\DataTransferObjects;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\DataTransferObject\DataTransferObject;

class CommentDTO extends DataTransferObject {

    public $id;
    public $user_id;
    public $vinyl_id;
    public $text;
    public $date;

    public static function createCommentObject(Request $request, $vinyl_id) {
        if ($request->isMethod('post')) {
            $data = $request->validate([
                'text' => 'required',
            ]);
            $data['user_id'] = Auth::user()->id;
            $data['vinyl_id'] = $vinyl_id;
            $data['date'] = date('y-m-d');
            $comment = new Comment($data);
            $comment->save();
            return new self ([
                'id' => $comment->id,
                'user_id' => $comment->user_id,
                'vinyl_id' => $comment->vinyl_id,
                'text' => $comment->text,
                'date' => $comment->date,
            ]);
        }
    }

    public static function deleteCommentObject(Request $request, Comment $comment) {
        if($request->isMethod('delete')) {
            if($comment->user_id == Auth::user()->id || Auth::user()->hasRole('admin')) {
                $comment->delete();
            }
        }
    }
}
