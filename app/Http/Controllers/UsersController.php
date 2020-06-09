<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Users\UpdateUserProfile;
use App\User;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index')->with('users', User::all());
    }

    public function edit() {

        return view('users.edit')->with('user', auth()->user());

    }

    public function update(UpdateUserProfile $request) {

        $user = auth()->user();

        $user->update([
            'name' => $request->name,
            'about'  => $request->about
        ]);

        session()->flash('success', 'User updated successfully.');

        return redirect()->back();

    }

    public function makeAdmin(User $user) {

        $user->role = 'admin';

        $user->save();

        session()->flash('success', 'User make admin successful.');

        return redirect(route('users.index'));
    }

}
