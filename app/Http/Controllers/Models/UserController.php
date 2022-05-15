<?php

namespace App\Http\Controllers\Models;

use App\Http\Controllers\Controller;
use App\Http\DataTransferObjects\UserDTO;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller {

    public function info() {
        return view('account');
    }

    public function edit(Request $request, $id) {
        $user = User::findOrFail($id);
        UserDTO::editUserData($request, $user);
        return redirect('/account');
    }
}
