<?php

namespace App\Http\DataTransferObjects;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Spatie\DataTransferObject\DataTransferObject;

class UserDTO extends DataTransferObject{

    public static function convert($img) {
        $filename = $img->getClientOriginalName();
        $img->move(Storage::path('original/'), $filename);
        $thumbnail = Image::make(Storage::path('original/').$filename);
        $thumbnail->fit(300, 300);
        $thumbnail->save(Storage::path('public/').$filename);
        return '/storage/'.$filename;
    }

    public static function editUserData(Request $request, User $user) {
        $authUser = Auth::user();
        if($request->isMethod('post') && $user->id == $authUser->id){
            $data = $request->validate([
                'name' => 'required|max:48',
                'avatar' => 'nullable',
                'email' => 'required', 'unique:users',
                'birthday' => 'nullable',
            ]);
            isset($data['avatar']) ?  $data['avatar']=self::convert($data['avatar']) : $data['avatar'] = Auth::user()->avatar;
            $user->name = $data['name'];$user->avatar = $data['avatar'];
            $user->email = $data['email'];
            $user->birthday = $data['birthday'];
            $user->save();
            return $user;
        }
    }
}
