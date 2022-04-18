<?php

namespace App\Http\Controllers\Models;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UserController extends Controller {

    public function info() {
        return view('account');
    }

    private function convert($img) {
        $filename = $img->getClientOriginalName();
        $img->move(Storage::path('original/'), $filename);
        $thumbnail = Image::make(Storage::path('original/').$filename);
        $thumbnail->fit(300, 300);
        $thumbnail->save(Storage::path('public/').$filename);
    }

    public function edit(Request $request, $id) {
        $authUser = Auth::user();
        $user = User::findOrFail($id);
        if($request->isMethod('post') && $user->id == $authUser->id){
            $data = $request->validate([
                'name' => 'required|max:48',
                'avatar' => 'nullable',
                'email' => 'required', 'unique:users',
                'birthday' => 'nullable',
            ]);
            isset($data['avatar']) ? $this->convert($data['avatar']) : $data['avatar'] = null;
            $user->name = $data['name'];
            isset($data['avatar']) ? $user->avatar = $data['avatar']->getClientOriginalName() : $user->avatar = $data['avatar'];
            $user->email = $data['email'];
            $user->birthday = $data['birthday'];
            $user->save();
            return redirect('/account');
        }
    }
}
