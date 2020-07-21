<?php

namespace App\Http\Controllers;

use App\Http\Requests\LecturerRequest;
use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::role('lecturer')->get();
        return view('users.index', compact('users'));
    }

    public function create(){
        return view('users.create');
    }

    public function store(LecturerRequest $request){
        $user = User::create($request->merge(['password' => Hash::make($request->password)])->all());
        $user->assignRole('lecturer');

        return back()->withStatus(__('Lecturer successfully created.'));
    }
}
