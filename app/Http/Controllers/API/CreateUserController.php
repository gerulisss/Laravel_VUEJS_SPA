<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUserController extends Controller
{
    public function index()
    {
        $users = User::all()->toArray();
        return array_reverse($users);
    }

    public function add(Request $request)
    {
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'age' => $request->age,
            'password' => Hash::make($request->password)
        ]);
        $user->save();

        return response()->json('The user successfully created');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }


    public function update($id, Request $request)
    {
        $user = User::find($id);
        $user->update($request->all());

        return response()->json('The user successfully updated');
    }


    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();

        return response()->json('The user successfully deleted');
    }
}
