<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function index(){

        $user = auth()->user();
        return response()->json($user, 200);
    }


    public function update(Request $request){

        $existingUser = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|max:255',Rule::unique('users')->ignore($existingUser),
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $existingUser->name = $request->name;
        $existingUser->email = $request->email;
        $existingUser->password = Hash::make($request->password);
        $existingUser->save();

        return response()->json($existingUser, 200);
       
    }


    public function destroy(){

        $user = Auth::user();
        $user->delete();

        return response()->json([
            'message' => 'Account Deleted Successfully!',
        ],200);

    }


    public function allUsers(){

        $users = User::all();
        return response()->json($users, 200);
    }
}
