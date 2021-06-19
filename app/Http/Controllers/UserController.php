<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class UserController extends Controller
{
    public function index()
    {
        $users = User::get();
        return view('admin-panel.user', compact('users'));
    }

    public function change_status($id, $status)
    {

        $user = User::findOrFail($id);
       // if($user->role != 'admin'){
            $user->status = $status;
            $user->save();
            return $user;
        //}
    }

    public function destroy_user($id)
    {
        User::destroy($id);
        return $id;
    }
}